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

    /**
     * The pairings that belong to the beer.
     */
    public function pairings()
    {
        return $this->belongsToMany('App\Pairing');
    }
}
