<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'tag',
        'slug',
        'description',
        'content',
        'image',
        'logo',
        'date_created',
        'item1_title',
        'item2_title',
        'item3_title',
        'value1',
        'value2',
        'value3',
        'hero_title',
        'hero_description',
        'hero_button_text',
        'hero_button_link',
        'hero_images',
        'why_title',
        'why_items',
        'steps_title',
        'steps_image',
        'steps_items',
        'team_title',
        'team_members',
        'testimonials_title',
        'testimonials',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_link',
        'cta_image',
        'date_updated',
        'category',
        'question',
        'answer',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'hero_images' => 'array',
        'why_items' => 'array',
        'steps_items' => 'array',
        'team_members' => 'array',
        'testimonials' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
