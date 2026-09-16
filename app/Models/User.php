<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'tel',
        'verificationCode',
        'status',
        'type',
        'is_agent',
        'name',
        'lname',
        'company',
        'agency_name',
        'bio',
        'avatar',
        'address',
        'email',
        'password',
        'instagram',
        'telegram',
        'whatsapp',
        'show_in_menu',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_agent' => 'boolean',
            'show_in_menu' => 'boolean',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
