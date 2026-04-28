<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Pages extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pages';
    public $timestamps = false;
    

    protected $fillable = [
        'title',
        'tag',
        'slug',
        'description',
        'content',
        'image',
        'date_created',
        'date_updated',
        
        'item1_title',
        'item2_title',
        'item3_title',
        'value1',
        'value2',
        'value3',
    ];


}
