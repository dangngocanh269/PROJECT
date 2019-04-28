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
Route::get('/',function (){
    return view('index');
});
Route::group(['prefix'=>'khoa'],function (){
    route::get('/','KhoaController@getview');
    route::get('/add','KhoaController@create');
    route::get('/edit/{id}','KhoaController@edit');
});

Route::group(['prefix'=>'chuyennganh'],function (){
    route::get('/','ChuyenNganhController@getview');
    route::get('/add','ChuyenNganhController@create');
    route::get('/edit/{id}','ChuyenNganhController@edit');
});
Route::group(['prefix'=>'monhoc'],function (){
    route::get('/','MonHocController@getview');
    route::get('/add','MonHocController@create');
    route::get('/edit/{id}','MonHocController@edit');
});
Route::group(['prefix'=>'sinhvien'],function (){
    route::get('/','SinhvienController@index');
    route::get('/add','SinhvienController@create');
    route::get('/edit/{id}','SinhvienController@edit');
});
Route::get('/tracuusv',function (){
    return view('tracuusv');
});
Route::get('tracuusv/search','SinhVienController@tracuusv');
Route::group(['prefix'=>'ajax'],function (){
    Route::get('/changekhoa/{id}','AjaxController@changekhoa');
    Route::get('/changecn/{id}','AjaxController@changecn');

});

