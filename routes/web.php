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

Route::view('/', 'welcome');

Route::get('ift3150/{student}', function ($student) {
    $view = "ift3150.$student";
    return View::exists($view) ? view($view) : abort(404);
});

Auth::routes(['register' => false, 'reset' => false]);

Route::middleware('auth')->group(function () {
    Route::view('home', 'home');

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::redirect('/', 'admin/artworks');

        Route::get('artworks', 'AdminController@artworks');
        Route::get('users', 'AdminController@users');
    });
});
