<?php

namespace App\Http\Controllers;

class SpaController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('spa.index');
    }
}
