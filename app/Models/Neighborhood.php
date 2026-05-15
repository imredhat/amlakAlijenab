<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Neighborhood extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'neighborhoods';
    
    protected $fillable = [
        'name',
        'tag',
        'city_id',
        'order',
        'showInMenu',
        'image'
    ];

    protected $attributes = [
        'showInMenu' => false 
    ];

    // رابطه با شهر
    public function city()
    {
        return $this->belongsTo(Cty::class, 'city_id');
    }
}