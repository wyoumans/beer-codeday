<?php

namespace App\Http\Controllers\Api;

use App\Recipe;
use App\Http\Resources\RecipeCollection;
use App\Http\Resources\RecipeResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RecipeCollection(Recipe::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }
}
