<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactsForm extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'tel',
        'message',
        'date_created',
        'date_updated',
    ];
}
