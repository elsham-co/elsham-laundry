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


Route::group(['middleware' => ['setLocale','auth']], function () {

    Route::get('/', 'CoreController@index')->name('dashboard')->middleware('permission:dashboard');
    Route::get('/change/{locale}', 'LanguageController@change_language')->name('change.language');
});
