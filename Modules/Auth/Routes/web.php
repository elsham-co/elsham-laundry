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
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/loggedIn', 'AuthController@login')->name('do.login');

Route::group(['middleware' => ['setLocale','auth']], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/profile', 'AuthController@profile')->name('profile');
    Route::put('/profile/update', 'AuthController@update_profile')->name('update.profile');

});
