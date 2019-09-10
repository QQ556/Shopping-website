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

Route::get('/', 'MerchandiseController@listMerchandise');


//會員登入開始
Auth::routes();

Route::group(['prefix' => 'user'], function () {
    //使用者登入
    Route::get('facebook-sign-in','UserAuthController@facebookSignInProcess');
    //facebook登入重新導航授權資料處理
    Route::get('facebook-sign-in-callback','UserAuthController@facebookSignInCallbackProcess');
//會員登入結束
});

Route::get('/home', 'HomeController@index')->name('home');

//商品
Route::group(['prefix' => 'merchandise'], function () {

    // (客用)商品列表檢視
    Route::get('/', 'MerchandiseController@listMerchandise');
    //商品資料新增
    Route::get('/create', 'MerchandiseController@create')->middleware(['user.auth.admin']);
    //交易
    Route::get('/transaction', 'TransactionController@listPage')->middleware(['user.auth']);


    //管理員專屬
    Route::group(['middleware' => ['user.auth.admin']], function () {
        //(後台)商品清單檢視
        Route::get('/manage', 'MerchandiseController@manageListPage');
        //單一商品編輯頁面檢視
        Route::get('/edit', 'MerchandiseController@edit');
    });


    // 指定商品
    Route::group(['prefix' => '{merchandise_id}'], function () {
        //單一商品編輯頁面檢視
        Route::get('/edit', 'MerchandiseController@edit');
        //單一商品資料修改
        Route::put('/', 'MerchandiseController@update');
        //單一商品資料修改
        Route::get('/', 'MerchandiseController@itemMerchandise');
        //購買
        Route::post('/buy', 'MerchandiseController@itemMerchandiseBuy')->middleware(['user.auth']);
        //單一商品刪除
        Route::delete('/', 'MerchandiseController@delete');
    });
});

