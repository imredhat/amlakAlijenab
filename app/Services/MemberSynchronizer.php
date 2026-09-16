<?php

namespace App\Services;

use App\Models\ContentItem;
use App\Models\PageDocument;
use DOMDocument;
use DOMElement;
use DOMXPath;

class MemberSynchronizer
{
    private const SLUGS=[
        'seyed-mostafa-taheri-otaghsara',
        'mehran-ramezani',
        'effat-ol-zaman-haghighi',
        'seyed-zia-hosseini',
    ];

    public function sync(bool $force=false): int
    {
        $count=0;
        foreach(PageDocument::whereIn('source_file',['about-fa.html','about-en.html','about-ar.html'])->where('is_published',true)->get() as $source){
            [$document,$xpath]=$this->document($source->html);
            $cards=$xpath->query('//*[contains(concat(" ",normalize-space(@class)," ")," member-card ")]');
            foreach($cards as $index=>$card){
                $info=$xpath->query('.//*[contains(concat(" ",normalize-space(@class)," ")," member-info ")]',$card)->item(0);
                if(!$info instanceof DOMElement)continue;
                $roleNode=$xpath->query('.//span',$info)->item(0);
                $linkNode=$xpath->query('.//a',$info)->item(0);
                $name=$linkNode?trim($linkNode->textContent):$this->nameWithoutRole($info,$roleNode);
                if($name==='')continue;
                $key='member-'.($index+1);
                $item=ContentItem::firstOrNew(['type'=>'member','key'=>$key]);
                if(!$item->exists){$item->fill(['status'=>'published','sort_order'=>$index,'is_featured'=>false,'settings'=>['source'=>'about']])->save();}
                $translation=$item->translations()->firstOrNew(['locale'=>$source->locale]);
                if(!$translation->exists||$force){
                    $photoText=$xpath->query('.//*[contains(concat(" ",normalize-space(@class)," ")," member-photo ")]//span',$card)->item(0);
                    $translation->fill(['title'=>$name,'slug'=>self::SLUGS[$index]??$key,'excerpt'=>$roleNode?trim($roleNode->textContent):'','body'=>null,'seo_title'=>$name,'data'=>['profile_url'=>$linkNode instanceof DOMElement?$linkNode->getAttribute('href'):'','initials'=>$photoText?trim($photoText->textContent):'']])->save();
                    $count++;
                }
            }
        }
        return $count;
    }

    public function render(string $html,string $locale): string
    {
        $members=ContentItem::with(['translations'=>fn($query)=>$query->where('locale',$locale)])->where('type','member')->where('status','published')->orderBy('sort_order')->get()->filter(fn($item)=>$item->translations->first());
        if($members->isEmpty())return $html;
        [$document,$xpath]=$this->document($html);
        $grid=$xpath->query('//*[contains(concat(" ",normalize-space(@class)," ")," member-grid ")]')->item(0);
        if(!$grid instanceof DOMElement)return $html;
        while($grid->firstChild)$grid->removeChild($grid->firstChild);
        foreach($members as $member){
            $tr=$member->translations->first();$data=$tr->data??[];$url=$data['profile_url']??'';$initials=$data['initials']??'';
            $name=$url!==''?'<a href="'.$this->e($url).'" target="_blank" rel="noopener">'.$this->e($tr->title).'</a>':$this->e($tr->title);
            $fragment=$document->createDocumentFragment();
            $fragment->appendXML('<article class="member-card"><div class="member-photo">'.($initials!==''?'<span>'.$this->e($initials).'</span>':'').'</div><div class="member-info">'.$name.'<span>'.$this->e($tr->excerpt).'</span></div></article>');
            $grid->appendChild($fragment);
        }
        $rendered=$document->saveHTML();
        return $rendered?str_replace(['&zwnj;','&zwj;'],["‌","‍"],mb_decode_numericentity($rendered,[0x80,0x10FFFF,0,0xFFFFFF],'UTF-8')):$html;
    }

    private function nameWithoutRole(DOMElement $info,$roleNode): string{$clone=$info->cloneNode(true);if($roleNode){$span=(new DOMXPath($clone->ownerDocument))->query('.//span',$clone)->item(0);if($span)$span->parentNode->removeChild($span);}return trim(preg_replace('/\s+/u',' ',$clone->textContent));}
    private function document(string $html): array{$document=new DOMDocument('1.0','UTF-8');$old=libxml_use_internal_errors(true);$document->loadHTML('<?xml encoding="UTF-8">'.$html,LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD);foreach($document->childNodes as $node){if($node->nodeType===XML_PI_NODE){$document->removeChild($node);break;}}libxml_clear_errors();libxml_use_internal_errors($old);return [$document,new DOMXPath($document)];}
    private function e(?string $value): string{return htmlspecialchars($value??'',ENT_XML1|ENT_QUOTES,'UTF-8');}
}
