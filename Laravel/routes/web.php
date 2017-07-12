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
    return view('welcome');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('login', 'UserController@login');
Route::get('api/login/{uid}/{pwd}', 'UserController@loginApi');

/*
*   Dummy restful api sample
*/
Route::get('api/dummy', 'DummyController@dummyGet');
Route::post('api/dummy', 'DummyController@dummyPost');
Route::put('api/dummy', 'DummyController@dummyPut');
Route::delete('api/dummy', 'DummyController@dummyDelete');

Route::get('api/users/{user_name}', 'UserController@userApi');