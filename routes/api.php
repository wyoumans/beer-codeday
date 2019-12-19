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
Route::get('/beers/{beer}', 'Api\BeerController@show')->name('api.beer.show');
Route::get('/beers', 'Api\BeerController@index')->name('api.beer.index');

// Pairings
Route::get('/pairings/{pairing}', 'Api\PairingController@show')->name('api.pairing.show');
Route::get('/pairings', 'Api\PairingController@index')->name('api.pairing.index');
