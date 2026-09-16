<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'category',
        'tags',
        'status',
        'views_count',
        'published_at',
        'date_created',
        'date_updated',
    ];

    protected $casts = [
        'tags' => 'array',
        'views_count' => 'integer',
        'published_at' => 'datetime',
    ];

    protected $attributes = [
        'views_count' => 0,
        'status' => 'draft',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
