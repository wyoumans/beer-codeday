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
     * The recipes that belong to the beer.
     */
    public function recipes()
    {
        return $this->belongsToMany('App\Recipe')
            ->withPivot('name')
            ->as('pairing')
            ->withTimestamps();
    }
}
