<?php

namespace App\Services;

use App\Models\ContentItem;
use App\Models\PageDocument;
use DOMDocument;
use DOMElement;
use DOMXPath;

class InternalPageSynchronizer
{
    private const KEYS = ['about','contact','order','agency','presale','gallery'];

    public function sync(bool $force = false): int
    {
        ContentItem::where('type','page')->whereIn('key',['home','index','blog','blog-post'])->delete();
        $sources=[];
        foreach(self::KEYS as $key) foreach(['fa','en','ar'] as $locale) $sources[]="{$key}-{$locale}.html";
        $documents = PageDocument::query()->where('is_published',true)->whereIn('source_file',$sources)->get()
            ->sortBy(fn($document)=>(array_search($document->page_key,self::KEYS,true)*10)+array_search($document->locale,['fa','en','ar'],true));
        $count = 0;
        foreach ($documents as $document) {
            $count += $this->import($document,$force);
        }
        return $count;
    }

    public function import(PageDocument $source, bool $force = false): int
    {
        [$document,$xpath] = $this->document($source->html);
        $main = $xpath->query('//main')->item(0);
        if (!$main instanceof DOMElement) return 0;
        $heading = $xpath->query('.//h1|.//h2',$main)->item(0);
        $intro = $xpath->query('.//p',$main)->item(0);
        $title = $this->text($heading) ?: $source->title;
        $excerpt = $this->text($intro);
        $body = $this->innerHtml($main);
        $seoTitle = $this->text($xpath->query('//title')->item(0)) ?: $source->title;
        $meta = $xpath->query('//meta[translate(@name,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz")="description"]')->item(0);
        $seoDescription = $meta instanceof DOMElement ? $meta->getAttribute('content') : '';
        $fields = $this->extractFields($xpath,$main,$heading,$intro);

        $item = ContentItem::withTrashed()->firstOrNew(['type'=>'page','key'=>$source->page_key]);
        if ($item->trashed()) {
            if (!$force) return 0;
            $item->restore();
        }
        $order = array_search($source->page_key,self::KEYS,true);
        $item->fill(['status'=>'published','sort_order'=>$order===false?99:$order+1,'settings'=>array_replace($item->settings??[],['page_key'=>$source->page_key,'source'=>'page-document'])]);
        if (!$item->exists) $item->published_at=now();
        $item->save();
        $translation = $item->translations()->firstOrNew(['locale'=>$source->locale]);
        $wasImported = isset($translation->data['imported']);
        if ($force || !$translation->exists || !$wasImported) {
            $translation->fill([
                'title'=>$title,'slug'=>$source->page_key,'excerpt'=>$excerpt,'body'=>$body,
                'seo_title'=>$seoTitle,'seo_description'=>$seoDescription,
                'data'=>['source_file'=>$source->source_file,'fields'=>$fields,'imported'=>compact('title','excerpt','body','seoTitle','seoDescription')],
            ])->save();
        } elseif (empty($translation->data['fields'])) {
            $data=$translation->data??[];$data['fields']=$fields;$translation->update(['data'=>$data]);
        }
        return 1;
    }

    public function render(string $html,string $pageKey,string $locale): ?string
    {
        if (!in_array($pageKey,self::KEYS,true)) return $html;
        $item=ContentItem::withTrashed()->with(['translations'=>fn($q)=>$q->where('locale',$locale)])->where(['type'=>'page','key'=>$pageKey])->first();
        if (!$item) return $html;
        if ($item->trashed() || $item->status!=='published') return null;
        $translation=$item->translations->first();
        if (!$translation) return $html;
        [$document,$xpath]=$this->document($html);
        $main=$xpath->query('//main')->item(0);
        if (!$main instanceof DOMElement) return $html;
        $imported=$translation->data['imported']??[];
        foreach($translation->data['fields']??[] as $field){
            if(($field['value']??null)===($field['original']??null)) continue;
            $node=$xpath->query($field['path']??'')->item(0);
            if($node) $node->textContent=$field['value']??'';
        }
        $heading=$xpath->query('.//h1|.//h2',$main)->item(0);
        $intro=$xpath->query('.//p',$main)->item(0);
        if ($heading&&$translation->title!==($imported['title']??null)) $heading->textContent=$translation->title;
        if ($intro&&$translation->excerpt!==($imported['excerpt']??null)) $intro->textContent=$translation->excerpt??'';
        $titleNode=$xpath->query('//title')->item(0);
        if ($titleNode&&filled($translation->seo_title)) $titleNode->textContent=$translation->seo_title;
        $meta=$xpath->query('//meta[translate(@name,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz")="description"]')->item(0);
        if ($meta instanceof DOMElement&&$translation->seo_description!==null) $meta->setAttribute('content',$translation->seo_description);
        $rendered=$document->saveHTML();
        return $rendered?str_replace(['&zwnj;','&zwj;'],["‌","‍"],mb_decode_numericentity($rendered,[0x80,0x10FFFF,0,0xFFFFFF],'UTF-8')):$html;
    }

    private function document(string $html): array { $d=new DOMDocument('1.0','UTF-8');$old=libxml_use_internal_errors(true);$d->loadHTML('<?xml encoding="UTF-8">'.$html,LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD);foreach($d->childNodes as $n){if($n->nodeType===XML_PI_NODE){$d->removeChild($n);break;}}libxml_clear_errors();libxml_use_internal_errors($old);return [$d,new DOMXPath($d)]; }
    private function text($node): string {return $node?trim(preg_replace('/\s+/u',' ',$node->textContent)):'';}
    private function innerHtml($node): string {$html='';foreach($node->childNodes as $child)$html.=$node->ownerDocument->saveHTML($child);return trim($html);}
    private function extractFields(DOMXPath $xpath,DOMElement $main,$heading=null,$intro=null): array
    {
        $fields=[];$nodes=$xpath->query('.//h1|.//h2|.//h3|.//p|.//li|.//dt|.//dd',$main);
        foreach($nodes as $node){
            if(($heading&&$node->isSameNode($heading))||($intro&&$node->isSameNode($intro)))continue;
            if($xpath->query('.//input|.//textarea|.//select|.//button|.//script|.//style',$node)->length)continue;
            $value=$this->text($node);if($value==='')continue;
            $fields[]=['path'=>$node->getNodePath(),'tag'=>$node->nodeName,'label'=>mb_substr($value,0,70),'original'=>$value,'value'=>$value];
        }
        return $fields;
    }
}
