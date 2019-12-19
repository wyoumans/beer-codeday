<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pairing extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * The beer that belong to the pairing.
     */
    public function beers()
    {
        return $this->belongsToMany('App\Beer');
    }
}
