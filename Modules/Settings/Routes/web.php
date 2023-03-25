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
    Route::get('/settings/edit', 'SettingsController@edit')->name('settings.edit')->middleware('permission:update-settings');
    Route::put('/settings/update', 'SettingsController@update')->name('settings.update')->middleware('permission:update-settings');
});
