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

Route::get('/', function () {
    return redirect('/users/');}
);

Route::get('/users', 'CustomUserController@index');
Route::post('/users', 'CustomUserController@save');
Route::delete('/users/{user}', 'CustomUserController@delete');
