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

Route::get('login/{uid}/{pwd}', 'UserController@loginApi');
Route::get('users/{user_name}', 'UserController@userApi');

/*
*   Dummy restful api sample
*/
Route::get('dummy', 'DummyController@dummyGet');
Route::post('dummy', 'DummyController@dummyPost');
Route::put('dummy', 'DummyController@dummyPut');
Route::delete('dummy', 'DummyController@dummyDelete');

Route::post('bet', 'BetController@betApi');
Route::post('rollback', 'BetController@rollbackApi');

