<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'SpaController@index')->name('spa.index');
Route::get('/beers', 'SpaController@index')->name('spa.index');
Route::get('/beers/{beer}', 'SpaController@index')->name('spa.index');
