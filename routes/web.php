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

Route::get('/', 'ToDosController@index');
Route::post('/', 'ToDosController@create');
Route::delete('/{id}', 'ToDosController@delete');
Route::get('/{id}', 'ToDosController@edit');
Route::put('/{id}', 'ToDosController@update');
Route::put('/{id}/complete', 'ToDosController@complete');
Route::put('/{id}/uncomplete', 'ToDosController@uncomplete');
