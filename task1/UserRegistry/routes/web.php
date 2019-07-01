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
    return redirect('/users');}
    );
Route::get('users', 'UserListingController@index');
Route::post('users', 'UserListingController@store');
Route::delete('users', 'UserListingController@destroy');
Route::get('run', function () {

});