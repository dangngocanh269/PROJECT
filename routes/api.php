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
Route::group(['prefix'=>'khoa'],function (){
    Route::get('/','KhoaController@index');
    Route::post('/add','KhoaController@store');
    Route::put('/update/{id}','KhoaController@update');
    Route::delete('/delete/{id}','KhoaController@destroy');
});
Route::group(['prefix'=>'chuyennganh'],function (){
    Route::get('/','ChuyenNganhController@index');
    Route::post('/add','ChuyenNganhController@store');
    Route::put('/update/{id}','ChuyenNganhController@update');
    Route::delete('/delete/{id}','ChuyenNganhController@destroy');
});
Route::group(['prefix'=>'monhoc'],function (){
    Route::get('/','MonHocController@index');
    Route::post('/add','MonHocController@store');
    Route::put('/update/{id}','MonHocController@update');
    Route::delete('/delete/{id}','MonHocController@destroy');
});
