<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'slug',
        'order',
        'date_created',
        'date_updated',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
