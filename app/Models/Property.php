<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Property extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'property';

    protected $fillable = [
        '_id',
        'category',
        'title',
        'description',
        'area',
        'price',
        'type'
    ];

    public function getAuthIdentifierName()
    {
        return '_id';
    }
}
