<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'position',
        'title',
        'desc',
        'pic',
        'link',
        'link_title',
        'type',
        'date_created',
        'date_updated',
    ];
}
