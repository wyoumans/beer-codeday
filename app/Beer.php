<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = [
        'punk_id',
        'name',
        'tagline',
        'description',
        'image_url',
        'abv',
    ];
}
