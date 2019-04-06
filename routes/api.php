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
    Route::resource('artworks', 'ArtworkController')->only(['index', 'show']);
    Route::resource('artists', 'ArtistController')->only(['index', 'show']);

    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::namespace('V1')->prefix('v1')->group(function () {
    Route::get('loadJson1', 'LoadJson');

    /* Authentication */
    Route::get('logUser', 'Auth\LoginController@login');
    Route::get('createUser', 'Auth\RegisterController@register');

    Route::get('addNote', 'UserController@rate');
    Route::get('addComment', 'UserController@comment');
    Route::get('addPicture', 'UserController@photograph');
});
