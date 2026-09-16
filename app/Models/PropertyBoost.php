<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyBoost extends Model
{
    protected $table = 'property_boosts';

    protected $fillable = [
        'property_id',
        'package_id',
        'user_id',
        'starts_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function package()
    {
        return $this->belongsTo(UpgradePackage::class, 'package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('expires_at', '>', now());
    }
}
