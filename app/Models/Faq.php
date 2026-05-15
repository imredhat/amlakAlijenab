<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Faq extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'faqs';
    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'slug',
        'order',
        'date_created',
        'date_updated'
    ];
}
