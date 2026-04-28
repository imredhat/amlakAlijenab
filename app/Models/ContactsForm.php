<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ContactsForm extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'contacts_forms';
    public $timestamps = false;
    

    protected $fillable = [
        'name',
        'tel',
        'message',
        'date_created',
        'date_updated',
    ];


}
