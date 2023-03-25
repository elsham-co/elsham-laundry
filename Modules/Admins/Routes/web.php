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
    Route::get('/admins', 'AdminsController@index')->name('admins.index')->middleware('permission:admins');
    Route::get('/admins/create', 'AdminsController@create')->name('admins.create')->middleware('permission:create-admin');
    // Route::get('/admins/create', 'AdminsController@create')->name('admins.create');
    Route::post('/admins/store', 'AdminsController@store')->name('admins.store')->middleware('permission:create-admin');
    // Route::post('/admins/store', 'AdminsController@store')->name('admins.store');
    Route::get('/admins/edit/{user}', 'AdminsController@edit')->name('admins.edit')->middleware('permission:update-admin');
    Route::put('/admins/update/{user}', 'AdminsController@update')->name('admins.update')->middleware('permission:update-admin');
    Route::delete('/admins/delete/{user}', 'AdminsController@destroy')->name('admins.destroy')->middleware('permission:delete-admin');
    Route::put('/admins/update/status/{user}', 'AdminUpdateStatusController@updateStatus')->name('admin.update.status')->middleware('permission:update-status-admin');
});
