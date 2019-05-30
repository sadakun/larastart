<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api untuk outlet


Route::apiResources([
    'outlet' => 'outlet_controller',
    'jenis_barang' => 'jenisBarang_controller',
    'produk' => 'produk_controller',
    'detail_penjualan' => 'detail_penjualan_controller',
    'profile' => 'user_controller',
    'user' => 'user_controller',
    
]);
Route::get('cariProduk' , 'detail_penjualan_controller@search');
Route::get('profile' , 'user_controller@profile');
Route::put('profile' , 'user_controller@updateProfile');


