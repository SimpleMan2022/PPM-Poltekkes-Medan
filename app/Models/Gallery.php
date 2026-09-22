<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'image',
        'event_date',
        'description',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
