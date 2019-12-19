<?php

namespace App\Http\Controllers\Api;

use App\Beer;
use App\Http\Resources\BeerCollection;
use App\Http\Resources\BeerResource;
use App\Http\Controllers\Controller;

class BeerController extends Controller
{
    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BeerCollection(Beer::paginate());
    }

    /**
     * Get the specified resource.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function show(Beer $beer)
    {
        return new BeerResource($beer);
    }

    /**
     * Get a random resouce
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        return new BeerResource(
            Beer::inRandomOrder()->first()
        );
    }
}
