<?php

namespace App\Http\Controllers\Api;

use App\Pairing;
use App\Http\Resources\PairingCollection;
use App\Http\Resources\PairingResource;
use Illuminate\Http\Request;

class PairingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PairingCollection(Pairing::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pairing  $pairing
     * @return \Illuminate\Http\Response
     */
    public function show(Pairing $pairing)
    {
        return new PairingResource($pairing);
    }
}
