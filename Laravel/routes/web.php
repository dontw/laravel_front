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
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('menu', 'UserController@menu')->name('menu');
Route::get('betaction', 'BetController@betaction')->name('betaction');
Route::get('rollbackaction', 'BetController@rollbackaction')->name('rollbackaction');
Route::get('resultaction', 'BetController@resultaction')->name('resultaction');
Route::get('betinfo', 'BetController@betInfo')->name('betinfo');

Route::get('hkjc', 'BetController@resultHKJC')->name('hkjc');

Route::get('login', 'UserController@login')->name('login');