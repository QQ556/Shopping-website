<?php

use Illuminate\Routing\RouteGroup;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//商品
Route::group(['prefix' => 'merchandise'], function () {
    //商品清單列表
    Route::get('/', 'MerchandiseController@listpage');
    //商品資料新增
    Route::get('/create', 'MerchandiseController@create');
    //管理清單
    Route::get('/admin', 'MerchandiseController@adminlist');


    // 指定商品
    Route::group(['prefix' => '{merchandise_id}'], function () {
        //單一商品檢視
        Route::get('/', 'MerchandiseController@index');
        //單一商品編輯頁面
        Route::get('/edit', 'MerchandiseController@edit');
        //單一商品修改
        Route::put('/', 'MerchandiseController@update');
        //購買
        Route::post('/buy', 'MerchandiseController@create');
    });
});
