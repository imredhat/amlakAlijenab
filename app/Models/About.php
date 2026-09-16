<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    public $timestamps = false;

    protected $fillable = [
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
    ];

    protected $casts = [
        'hero_images' => 'array',
        'why_items' => 'array',
        'steps_items' => 'array',
        'team_members' => 'array',
        'testimonials' => 'array',
    ];
}
