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

// Route::group(['middleware' => ['setLocale','auth','permission:permissions']], function () {
//     Route::resource('/permissions', 'PermissionsController');
// });

Route::group(['middleware' => ['setLocale','auth']], function () {
    Route::get('/permissions', 'PermissionsController@index')->name('permissions.index')->middleware('permission:roles');
   
    Route::post('/permissions/store', 'PermissionsController@store')->name('permissions.store');
    Route::get('/permissions/edit/{permission}', 'PermissionsController@edit')->name('permissions.edit');
    
    Route::put('/permissions/update/{permission}', 'PermissionsController@update')->name('permissions.update');
    Route::delete('/permissions/delete/{permission}', 'PermissionsController@destroy')->name('permissions.destroy');
});