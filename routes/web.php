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


Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home.index']);
Route::get('/about', ['uses' => 'HomeController@about', 'as' => 'home.index']);
Route::get('/contact', ['uses' => 'HomeController@contact', 'as' => 'home.contact']);
Route::post('/producto/create', ['uses' => 'HomeController@create', 'as' => 'producto.create']);
Route::post('/producto/update', ['uses' => 'HomeController@update', 'as' => 'producto.update']);