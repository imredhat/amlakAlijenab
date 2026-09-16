<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $fillable = [
        'name',
        'tag',
        'city_id',
        'order',
        'showInMenu',
        'image',
    ];

    protected $attributes = [
        'showInMenu' => false,
    ];

    protected function casts(): array
    {
        return [
            'showInMenu' => 'boolean',
        ];
    }

    public function city()
    {
        return $this->belongsTo(Cty::class, 'city_id');
    }
}
