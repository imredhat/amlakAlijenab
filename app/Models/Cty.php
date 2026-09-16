<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cty extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'tag',
        'order',
        'image',
        'date_created',
        'date_updated',
    ];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }
}
