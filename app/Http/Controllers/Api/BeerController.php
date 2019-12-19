<?php

namespace App\Http\Controllers\Api;

use App\Beer;
use App\Http\Resources\BeerCollection;
use App\Http\Resources\BeerResource;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BeerCollection(Beer::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function show(Beer $beer)
    {
        return new BeerResource($beer);
    }
}
