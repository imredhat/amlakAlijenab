<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Section extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'sections';
    public $timestamps = false;


    protected $fillable = [
        'position',
        'title',
        'desc',
        'pic',
        'link',
        'link_title',
        'date_created',
        'date_updated'
    ];
}
