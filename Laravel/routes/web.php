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
| 1.只要是回傳view的route，都要對此路由命名 ex: Route::get('betinfo', 'UserController@betInfo')->name('betinfo');
| 2.若是屬於只回傳資料的route，開頭一律加上 api/ ex: Route::get('api/dummy', 'DummyController@dummyGet');
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('menu', 'UserController@menu')->name('menu');
Route::get('betaction', 'UserController@betaction')->name('betaction');
Route::get('betinfo', 'UserController@betInfo')->name('betinfo');

Route::get('hkjc', 'UserController@resultHKJC')->name('hkjc');

Route::get('login', 'UserController@login')->name('login');
Route::get('api/login/{uid}/{pwd}', 'UserController@loginApi');

/*
*   Dummy restful api sample
*/
Route::get('api/dummy', 'DummyController@dummyGet');
Route::post('api/dummy', 'DummyController@dummyPost');
Route::put('api/dummy', 'DummyController@dummyPut');
Route::delete('api/dummy', 'DummyController@dummyDelete');

Route::get('api/users/{user_name}', 'UserController@userApi');