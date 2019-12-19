<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Beers
Route::get('/beers/random', 'Api\BeerController@random')->name('api.beers.random');
Route::get('/beers/{beer}', 'Api\BeerController@show')->name('api.beers.show');
Route::get('/beers', 'Api\BeerController@index')->name('api.beers.index');

// Recipe
Route::get('/recipes/{recipe}', 'Api\RecipeController@show')->name('api.recipes.show');
Route::get('/recipes', 'Api\RecipeController@index')->name('api.recipes.index');
