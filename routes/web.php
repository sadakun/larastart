<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//adding route history for saving any path
Route::get('{path}', "HomeController@index")->where('path', '([A-z\d\-/_.]+)?');

//Route::get('{path}', "HomeController@index")->where('path', '(/^[a-z0-9]([0-9a-z_\-\s])+$/i)');