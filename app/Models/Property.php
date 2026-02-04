<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
<<<<<<< HEAD
=======
use Hekmatinasser\Verta\Verta;
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232

class Property extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'property';
<<<<<<< HEAD
=======
    public $timestamps = false;
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232

    protected $fillable = [
        '_id',
        'category',
        'title',
        'description',
        'area',
        'price',
<<<<<<< HEAD
        'type'
=======
        'type',
        'date_created',
        'date_updated'
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
    ];

    public function getAuthIdentifierName()
    {
        return '_id';
    }
}
