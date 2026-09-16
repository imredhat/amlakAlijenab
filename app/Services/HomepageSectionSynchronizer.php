<?php

namespace App\Services;

use App\Models\ContentItem;
use DOMDocument;
use DOMElement;
use DOMXPath;

class HomepageSectionSynchronizer
{
    public function import(string $sourceFile, string $locale, string $html, bool $force = false): int
    {
        if (!str_starts_with($sourceFile, 'index-')) {
            return 0;
        }

        [$document, $xpath] = $this->document($html);
        $sections = $xpath->query('//section[@id]');
        $count = 0;

        foreach ($sections as $position => $section) {
            if (!$section instanceof DOMElement) {
                continue;
            }

            $key = trim($section->getAttribute('id'));
            if ($key === '') {
                continue;
            }

            $heading = $xpath->query('.//h1|.//h2|.//h3', $section)->item(0);
            $tag = $xpath->query('.//*[contains(concat(" ", normalize-space(@class), " "), " tag ") or contains(concat(" ", normalize-space(@class), " "), " eyebrow ")]', $section)->item(0);
            $paragraph = $xpath->query('.//p[contains(concat(" ", normalize-space(@class), " "), " section-desc ") or contains(concat(" ", normalize-space(@class), " "), " hero-desc ") or contains(concat(" ", normalize-space(@class), " "), " sub ")]|.//p', $section)->item(0);

            $title = $this->text($heading) ?: $this->label($key, $locale);
            $excerpt = $this->text($tag);
            $body = $paragraph ? $this->innerHtml($paragraph) : '';
            $item = ContentItem::firstOrNew(['type' => 'section', 'key' => $key]);
            $backgrounds = ['hero'=>'hero_bg.jpg','purity'=>'spring_bg.jpg','crafted'=>'building_bg.jpg','products'=>'products_bg.jpg','family'=>'family_bg.jpg','contact'=>'footer_bg.jpg'];
            $settings = $item->settings ?? [];
            $settings['section_id'] = $key;
            $settings['source'] = 'homepage-html';
            if (isset($backgrounds[$key]) && empty($settings['background_default'])) {
                $settings['background_default'] = $backgrounds[$key];
            }
            $item->fill([
                'status' => 'published',
                'sort_order' => $position + 1,
                'settings' => $settings,
            ]);
            if (!$item->exists) {
                $item->published_at = now();
            }
            $item->save();

            $translation = $item->translations()->firstOrNew(['locale' => $locale]);
            if ($force || !$translation->exists || blank($translation->title)) {
                $translation->fill([
                    'title' => $title,
                    'slug' => 'section-'.$key,
                    'excerpt' => $excerpt,
                    'body' => $body,
                    'seo_title' => $title,
                    'data' => [
                        'source_file' => $sourceFile,
                        'section_id' => $key,
                        'imported' => ['title' => $title, 'excerpt' => $excerpt, 'body' => $body],
                    ],
                ])->save();
            }
            $count++;
        }

        return $count;
    }

    public function render(string $html, string $locale): string
    {
        $items = ContentItem::query()
            ->with(['translations' => fn ($query) => $query->where('locale', $locale)])
            ->where('type', 'section')
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get();

        if ($items->isEmpty()) {
            return $html;
        }

        [$document, $xpath] = $this->document($html);
        foreach ($items as $item) {
            $translation = $item->translations->first();
            $sectionId = $item->settings['section_id'] ?? $item->key;
            $section = $xpath->query('//section[@id='.$this->xpathLiteral($sectionId).']')->item(0);
            if (!$translation || !$section instanceof DOMElement) {
                continue;
            }

            $background = $item->settings['background_path'] ?? null;
            if ($background) {
                $backgroundTarget = $xpath->query('.//*[contains(concat(" ", normalize-space(@class), " "), " bg-layer ")]', $section)->item(0) ?? $section;
                $style = rtrim($backgroundTarget->getAttribute('style'), '; ');
                $safeBackground = str_replace(["'", ')'], '', $background);
                $backgroundTarget->setAttribute('style', ($style ? $style.';' : '')."background-image:url('/storage/{$safeBackground}')");
            }

            $imported = $translation->data['imported'] ?? [];
            $heading = $xpath->query('.//h1|.//h2|.//h3', $section)->item(0);
            $tag = $xpath->query('.//*[contains(concat(" ", normalize-space(@class), " "), " tag ") or contains(concat(" ", normalize-space(@class), " "), " eyebrow ")]', $section)->item(0);
            $paragraph = $xpath->query('.//p[contains(concat(" ", normalize-space(@class), " "), " section-desc ") or contains(concat(" ", normalize-space(@class), " "), " hero-desc ") or contains(concat(" ", normalize-space(@class), " "), " sub ")]|.//p', $section)->item(0);

            if ($heading && filled($translation->title) && $translation->title !== ($imported['title'] ?? null)) {
                $heading->textContent = $translation->title;
            }
            if ($tag && $translation->excerpt !== ($imported['excerpt'] ?? null)) {
                $tag->textContent = $translation->excerpt ?? '';
            }
            if ($paragraph && $translation->body !== ($imported['body'] ?? null)) {
                $this->replaceInnerHtml($document, $paragraph, $translation->body ?? '');
            }
        }

        $rendered = $document->saveHTML();
        return $rendered
            ? mb_decode_numericentity($rendered, [0x80, 0x10FFFF, 0, 0xFFFFFF], 'UTF-8')
            : $html;
    }

    private function document(string $html): array
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8">'.$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        foreach ($document->childNodes as $node) {
            if ($node->nodeType === XML_PI_NODE) {
                $document->removeChild($node);
                break;
            }
        }
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        return [$document, new DOMXPath($document)];
    }

    private function text($node): string
    {
        return $node ? trim(preg_replace('/\s+/u', ' ', $node->textContent)) : '';
    }

    private function innerHtml($node): string
    {
        $html = '';
        foreach ($node->childNodes as $child) {
            $html .= $node->ownerDocument->saveHTML($child);
        }
        return trim($html);
    }

    private function replaceInnerHtml(DOMDocument $document, $node, string $html): void
    {
        while ($node->firstChild) {
            $node->removeChild($node->firstChild);
        }
        if ($html === '') {
            return;
        }
        $fragment = $document->createDocumentFragment();
        if (@$fragment->appendXML($html)) {
            $node->appendChild($fragment);
        } else {
            $node->textContent = strip_tags($html);
        }
    }

    private function xpathLiteral(string $value): string
    {
        return "'".str_replace("'", "&apos;", $value)."'";
    }

    private function label(string $key, string $locale): string
    {
        $labels = ['fa' => ['hero'=>'هیرو','purity'=>'سرچشمه خلوص','crafted'=>'فلسفه ما','products'=>'محصولات','values'=>'ارزش‌ها','family'=>'طراوت طبیعت','contact'=>'تماس'], 'en' => [], 'ar' => []];
        return $labels[$locale][$key] ?? ucfirst($key);
    }
}
