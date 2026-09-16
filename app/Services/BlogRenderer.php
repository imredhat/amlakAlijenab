<?php

namespace App\Services;

use App\Models\ContentItem;

class BlogRenderer
{
    public function render(string $html,string $locale,?string $requestedSlug=null): ?string
    {
        $posts=ContentItem::query()
            ->with(['translations'=>fn($query)=>$query->where('locale',$locale)])
            ->where('type','post')->where('status','published')
            ->orderByDesc('is_featured')->orderBy('sort_order')->get()
            ->filter(fn(ContentItem $post)=>$post->translations->first())->values();

        return $requestedSlug!==null
            ? $this->detail($html,$locale,$requestedSlug,$posts)
            : $this->listing($html,$locale,$posts);
    }

    private function listing(string $html,string $locale,$posts): string
    {
        $featured=$posts->first();
        if($featured){
            $tr=$featured->translations->first();
            $featuredHtml='<section class="featured-post"><div class="featured-image"></div><div class="featured-copy"><span class="post-category">'.$this->e($this->category($featured,$tr)).'</span><h2>'.$this->e($tr->title).'</h2><p>'.$this->e($tr->excerpt??'').'</p><a href="/'.$locale.'/article?post='.$this->slug($featured,$tr).'">'.$this->readLabel($locale).' <span>←</span></a></div></section>';
            $html=preg_replace('/<section class="featured-post">.*?<\/section>/su',$featuredHtml,$html,1)??$html;
        }
        $cards=$posts->map(function(ContentItem $post)use($locale){$tr=$post->translations->first();$url='/'.$locale.'/article?post='.$this->slug($post,$tr);return '<article class="post-card"><a class="post-image" href="'.$url.'" aria-label="'.$this->e($tr->title).'"></a><div><span>'.$this->e($this->category($post,$tr)).'</span><h3><a href="'.$url.'">'.$this->e($tr->title).'</a></h3><p>'.$this->e($tr->excerpt??'').'</p><a class="read" href="'.$url.'">'.$this->readLabel($locale).' ←</a></div></article>'; })->implode('');
        return preg_replace('/(<div class="post-grid">).*?(<\/div>\s*<\/section>)/su','$1'.$cards.'$2',$html,1)??$html;
    }

    private function detail(string $html,string $locale,string $slug,$posts): ?string
    {
        $post=$posts->first(fn(ContentItem $item)=>$item->key===$slug||$item->translations->first()?->slug===$slug);
        if(!$post)return null;
        $tr=$post->translations->first();
        $values=['category'=>$this->category($post,$tr),'title'=>$tr->title,'lead'=>$tr->excerpt??''];
        foreach($values as $id=>$value)$html=preg_replace('/(<[^>]+id="'.preg_quote($id,'/').'"[^>]*>).*?(<\/[^>]+>)/su','$1'.$this->e($value).'$2',$html,1)??$html;
        $html=preg_replace('/(<div class="article-body" id="content">).*?(<\/div>)/su','$1'.($tr->body??'').'$2',$html,1)??$html;
        $html=preg_replace('/<script>\s*const posts=.*?<\/script>/su','',$html)??$html;
        $html=preg_replace('/<title>.*?<\/title>/su','<title>'.$this->e($tr->seo_title?:$tr->title).'</title>',$html,1)??$html;
        return $html;
    }

    private function category(ContentItem $post,$translation): string{return $translation->data['category']??$post->settings['category']??'';}
    private function slug(ContentItem $post,$translation): string{return rawurlencode($translation->slug?:$post->key);}
    private function readLabel(string $locale): string{return match($locale){'en'=>'Read article','ar'=>'اقرأ المقال',default=>'مطالعه مطلب'};}
    private function e(?string $value): string{return htmlspecialchars($value??'',ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
}
