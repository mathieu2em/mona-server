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

Route::namespace('V2')->middleware('json')->group(function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::namespace('V1')->prefix('v1')->group(function () {
    Route::get('logUser', 'Auth\LoginController@login');
    Route::get('createUser', 'Auth\RegisterController@register');
});
