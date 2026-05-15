<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cty extends Model
{
    use HasFactory;


    protected $connection = 'mongodb';
    protected $collection = 'cties';
    public $timestamps = false;



    protected $fillable = [
        'id',
        'name',
        'tag',
        'order',
        'image',
        'date_created',
        'date_updated'
    ];

    public function neighborhoods()
{
    return $this->hasMany(Neighborhood::class);
}
}
