<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopAgent extends Model
{
    protected $fillable = [
        'user_id',
        'custom_text',
        'order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
