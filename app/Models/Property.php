<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Hekmatinasser\Verta\Verta;

class Property extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'property';
    public $timestamps = false;

    protected $fillable = [
        '_id',
        'category',
        'title',
        'description',
        'area',
        'price',
        'type',
        'date_created',
        'date_updated'
    ];

    public function getAuthIdentifierName()
    {
        return '_id';
    }
}
