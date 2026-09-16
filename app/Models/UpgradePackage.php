<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpgradePackage extends Model
{
    protected $table = 'upgrade_packages';

    protected $fillable = [
        'name',
        'price',
        'duration_days',
        'view_multiplier',
        'is_top_listed',
        'is_special_badge',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_top_listed' => 'boolean',
        'is_special_badge' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function boosts()
    {
        return $this->hasMany(PropertyBoost::class, 'package_id');
    }
}
