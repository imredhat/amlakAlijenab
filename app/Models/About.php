<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class About extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'about';
    public $timestamps = false;

    protected $fillable = [
        // بخش هرو
        'hero_title',
        'hero_description',
        'hero_button_text',
        'hero_button_link',
        'hero_images',        // آرایه از مسیر تصاویر

        // بخش دلایل انتخاب
        'why_title',
        'why_items',          // آرایه: [{icon_svg, title, description}]

        // بخش مراحل همکاری
        'steps_title',
        'steps_image',
        'steps_items',        // آرایه: [{number, title, description}]

        // بخش تیم
        'team_title',
        'team_members',       // آرایه: [{name, role, photo, facebook, twitter, instagram}]

        // بخش نظرات
        'testimonials_title',
        'testimonials',       // آرایه: [{text, company, person_name, person_role, logo}]

        // بخش پایانی CTA
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_link',
        'cta_image',

        'date_updated',
    ];
}