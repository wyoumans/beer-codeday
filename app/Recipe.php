<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'edamam_id',
        'url',
        'label',
        'source',
        'image_url',
        'share_url',
    ];

    /**
     * The beer that belong to the pairing.
     */
    public function beers()
    {
        return $this->belongsToMany('App\Beer')
            ->withPivot('name')
            ->as('pairing')
            ->withTimestamps();
    }
}
