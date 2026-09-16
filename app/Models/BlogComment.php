<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'blog_id',
        'name',
        'tel',
        'message',
        'is_approved',
        'created_at',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
