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
    Route::get('/roles', 'RolesController@index')->name('roles.index')->middleware('permission:roles');
    Route::get('/roles/create', 'RolesController@create')->name('roles.create')->middleware('permission:create-role');
    // Route::get('/roles/create', 'RolesController@create')->name('roles.create');
    Route::post('/roles/store', 'RolesController@store')->name('roles.store')->middleware('permission:create-role');
    Route::get('/roles/edit/{role}', 'RolesController@edit')->name('roles.edit')->middleware('permission:update-role');
    // Route::get('/roles/edit/{role}', 'RolesController@edit')->name('roles.edit');

    Route::put('/roles/update/{role}', 'RolesController@update')->name('roles.update')->middleware('permission:update-role');
    Route::delete('/roles/delete/{role}', 'RolesController@destroy')->name('roles.destroy')->middleware('permission:delete-role');
});
