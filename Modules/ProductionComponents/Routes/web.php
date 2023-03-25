<?php

use Illuminate\Support\Facades\Route;

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
    // ColorStagesController Routes\\
    Route::get('colors/', 'ColorStagesController@index')->name('colors.index')->middleware('permission:components');
    Route::get('/colors/create', 'ColorStagesController@create')->name('colors.create')->middleware('permission:create_colors');

      Route::post('/colors/save', 'ColorStagesController@save')->name('colors.store')->middleware('permission:create_colors');
    Route::get('/colors/edit/{color}', 'ColorStagesController@edit')->name('colors.edit')->middleware('permission:update-colors');
    Route::put('/colors/update/{color}', 'ColorStagesController@update')->name('colors.update')->middleware('permission:update-colors');
    Route::delete('/colors/delete/{color}', 'ColorStagesController@destroy')->name('colors.destroy')->middleware('permission:delete-colors');
    Route::get('/colors/deleted_Color', 'ColorStagesController@deletedcolors')->name('colors.trashed.index')->middleware('permission:restore-colors');
    Route::get('/colors/restore/{color}', 'ColorStagesController@restoreColor')->name('colors.restore')->middleware('permission:restore-colors');
    Route::get('/colors/xlsx', 'ColorsExpertReportController@Colorsxlsx')->name('colors.xlsx')->middleware('permission:print_components');
    Route::get('/colors/print', 'ColorStagesController@printColors')->name('colors.print')->middleware('permission:print_components');
     /* */
     // ColorcategoryController Routes\\
Route::get('colors/CCategory/', 'ColorcategoryController@index')->name('ccategory.index')->middleware('permission:components');
Route::post('/colors/CCategory/store', 'ColorcategoryController@store')->name('ccategory.store')->middleware('permission:create_colors');
Route::get('/colors/CCategory/edit/{colcategory}', 'ColorcategoryController@edit')->name('ccategory.edit')->middleware('permission:update-colors');
Route::put('/colors/CCategory/update/{colcategory}', 'ColorcategoryController@update')->name('ccategory.update')->middleware('permission:update-colors');
Route::delete('/colors/CCategory/delete/{colcategory}', 'ColorcategoryController@destroy')->name('ccategory.destroy')->middleware('permission:delete-colors');
Route::get('/colors/CCategory/deleted_ColorCategory', 'ColorcategoryController@deletedCategorycol')->name('ccategory.trashed.index')->middleware('permission:restore-colors');
Route::get('/colors/CCategory/restore/{colcategory}', 'ColorcategoryController@restoreColCategory')->name('ccategory.restore')->middleware('permission:restore-colors');
// ====================================================================================================================
    // ThreadsController Routes\\
Route::get('Threads/', 'ThreadsController@index')->name('Threads.index')->middleware('permission:components');
Route::get('/Threads/create', 'ThreadsController@create')->name('Threads.create')->middleware('permission:create-thread');
Route::post('/Threads/store', 'ThreadsController@store')->name('Threads.store')->middleware('permission:create-thread');
Route::get('/Threads/edit/{thread}', 'ThreadsController@edit')->name('Threads.edit')->middleware('permission:update-thread');

Route::put('/Threads/update/{thread}', 'ThreadsController@update')->name('Threads.update');
// ->middleware('permission:update-thread');
Route::delete('/Threads/delete/{thread}', 'ThreadsController@destroy')->name('Threads.destroy')->middleware('permission:delete-thread');
Route::get('/Threads/deleted_thread', 'ThreadsController@deletedThreads')->name('Threads.trashed.index')->middleware('permission:restore-thread');
Route::get('/Threads/restore/{thread}', 'ThreadsController@restoreThread')->name('Threads.restore')->middleware('permission:restore-thread');
Route::get('/Threads/xlsx', 'ThreadsEpertReportController@Threadsxlsx')->name('Threads.xlsx')->middleware('permission:print_components');
Route::get('/Threads/xlsxT', 'ThreadsEpertReportController@ThreadsTrashedxlsx')->name('ThreadsTrashed.xlsx')->middleware('permission:print_components');
Route::get('/Threads/print', 'ThreadsController@printOrder')->name('Threads.print')->middleware('permission:print_components');
// ====================================================================================================================
    // FabricsController Routes\\
Route::get('Fabrics/', 'FabricsController@index')->name('Fabrics.index')->middleware('permission:components');
Route::get('/Fabrics/create', 'FabricsController@create')->name('Fabrics.create')->middleware('permission:create-fabric');
Route::post('/Fabrics/store', 'FabricsController@store')->name('Fabrics.store')->middleware('permission:create-fabric');
Route::get('/Fabrics/edit/{Fabric}', 'FabricsController@edit')->name('Fabrics.edit')->middleware('permission:update-fabric');
Route::put('/Fabrics/update/{Fabric}', 'FabricsController@update')->name('Fabrics.update')->middleware('permission:update-fabric');
Route::delete('/Fabrics/delete/{Fabric}', 'FabricsController@destroy')->name('Fabrics.destroy')->middleware('permission:delete-fabric');
Route::get('/Fabrics/deleted_Fabric', 'FabricsController@deletedFabrics')->name('Fabrics.trashed.index')->middleware('permission:restor-fabric');
Route::get('/Fabrics/restore/{Fabric}', 'FabricsController@restoreThread')->name('Fabrics.restore')->middleware('permission:restor-fabric');
Route::get('/Fabrics/show/{Fabric}', 'FabricsController@show')->name('Fabrics.show')->middleware('permission:view-fabric');
Route::get('/Fabrics/xlsx', 'FabricsExpertReportController@Fabricsxlsx')->name('Fabrics.xlsx')->middleware('permission:print_components');
Route::get('/Fabrics/print', 'FabricsController@printFabrics')->name('Fabrics.print')->middleware('permission:print_components');
 /* */
     // FabricCategoryController Routes\\
Route::get('Fabrics/Category/', 'FabricCategoryController@index')->name('Category.index')->middleware('permission:components');
Route::post('/Fabrics/Category/store', 'FabricCategoryController@store')->name('category.store')->middleware('permission:create-fabric');
Route::get('/Fabrics/Category/edit/{fabcategory}', 'FabricCategoryController@edit')->name('Category.edit')->middleware('permission:update-fabric');
Route::put('/Fabrics/Category/update/{fabcategory}', 'FabricCategoryController@update')->name('Category.update')->middleware('permission:update-fabric');
Route::delete('/Fabrics/Category/delete/{fabcategory}', 'FabricCategoryController@destroy')->name('Category.destroy')->middleware('permission:delete-fabric');
Route::get('/Fabrics/Category/deleted_FabricCategory', 'FabricCategoryController@deletedCategoryfab')->name('Category.trashed.index')->middleware('permission:restor-fabric');
Route::get('/Fabrics/Category/restore/{fabcategory}', 'FabricCategoryController@restoreFabCategory')->name('Category.restore')->middleware('permission:restor-fabric');
// ====================================================================================================================
    // FashionsController Routes\\
    Route::get('Fashions/', 'FashionsController@index')->name('Fashions.index')->middleware('permission:components');
Route::get('/Fashions/create', 'FashionsController@create')->name('Fashions.create')->middleware('permission:create-fashion');
Route::post('/Fashions/store', 'FashionsController@store')->name('Fashions.store')->middleware('permission:create-fashion');
Route::get('/Fashions/edit/{fashion}', 'FashionsController@edit')->name('Fashions.edit')->middleware('permission:update-fashion');
Route::put('/Fashions/update/{fashion}', 'FashionsController@update')->name('Fashions.update')->middleware('permission:update-fashion');
Route::delete('/Fashions/delete/{fashion}', 'FashionsController@destroy')->name('Fashions.destroy')->middleware('permission:delete-fashion');
Route::get('/Fashions/deleted_Fashion', 'FashionsController@deletedFashions')->name('Fashions.trashed.index')->middleware('permission:restore-fashion');
Route::get('/Fashions/restore/{fashion}', 'FashionsController@restoreFashion')->name('Fashions.restore')->middleware('permission:restore-fashion');
Route::get('/Fashions/xlsx', 'FashionsExpertReportController@Fashionsxlsx')->name('Fashions.xlsx')->middleware('permission:print_components');
Route::get('/Fashions/print', 'FashionsController@printFashions')->name('Fashions.print')->middleware('permission:print_components');
 /* */
     // FashionCategoryController Routes\\
     Route::get('Fashions/FasCategory/', 'FashionCategoryController@index')->name('fascategory.index')->middleware('permission:components');
     Route::post('/Fashions/FasCategory/store', 'FashionCategoryController@store')->name('fascategory.store')->middleware('permission:create-fashion');
     Route::get('/Fashions/FasCategory/edit/{fascategory}', 'FashionCategoryController@edit')->name('fascategory.edit')->middleware('permission:update-fashion');
Route::put('/Fashions/FasCategory/update/{fascategory}', 'FashionCategoryController@update')->name('fascategory.update')->middleware('permission:update-fashion');
Route::delete('/Fashions/FasCategory/delete/{fascategory}', 'FashionCategoryController@destroy')->name('fascategory.destroy')->middleware('permission:delete-fashion');
Route::get('/Fashions/FasCategory/deleted_FashionCategory', 'FashionCategoryController@deletedCategoryFas')->name('fascategory.trashed.index')->middleware('permission:restore-fashion');
Route::get('/Fashions/FasCategory/restore/{fascategory}', 'FashionCategoryController@restoreFasCategory')->name('fascategory.restore')->middleware('permission:restore-fashion');
});

//Route::resource('Threads',ThreadsController::class);