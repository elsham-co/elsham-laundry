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

use Modules\ProductionOrders\Http\Controllers\StoreController;

Route::group(['middleware' => ['setLocale','auth']], function () {
    // ColorStagesController Routes\\
    Route::get('orders/', 'ProductionOrdersController@index')->name('orders.index')->middleware('permission:orders');
    Route::get('/orders/create', 'ProductionOrdersController@create')->name('orders.create')->middleware('permission:create_orders');
    Route::post('/colors/store', 'ProductionOrdersController@store')->name('orders.store')->middleware('permission:create_orders');
    // Route::get('/colors/edit/{color}', 'ColorStagesController@edit')->name('colors.edit');
    // Route::put('/colors/update/{color}', 'ColorStagesController@update')->name('colors.update');
    // Route::delete('/colors/delete/{color}', 'ColorStagesController@destroy')->name('colors.destroy');
    // Route::get('/colors/deleted_Color', 'ColorStagesController@deletedcolors')->name('colors.trashed.index');
    // Route::get('/colors/restore/{color}', 'ColorStagesController@restoreColor')->name('colors.restore');
    // Route::get('/colors/xlsx', 'ColorsExpertReportController@Colorsxlsx')->name('colors.xlsx');
    // Route::get('/colors/print', 'ColorStagesController@printColors')->name('colors.print');



        // ColorStagesController Routes\\
        Route::get('oresreceipt/', 'OresController@index')->name('oresreceipt.index')->middleware('permission:ores_receipt');
        Route::get('/oresreceiptt/create', 'OresController@create')->name('oresreceipt.create')->middleware('permission:create_ores');
        Route::post('/oresreceiptt/store', 'OresController@store')->name('oresreceipt.store')->middleware('permission:create_ores');
        Route::get('/oresreceiptt/Oresid_code/{ores}', 'OresController@vieworescode')->name('oresreceipt.viewcode');
        Route::get('/oresreceiptt/print_ores/{ores}', 'OresController@printOres')->name('oresreceipt.print');
        
        // ->middleware('permission:print_ores');

        
        // Route::get('/order/print/{order}', 'PrintOrderController@printOres')->name('oresreceipt.print')->middleware('permission:view-order');
        // ->middleware('permission:create_ores');

        //// start---pro_follow_up///
        Route::get('/follow_up/index','StoreController@index')->name('pro_follow_up.index')->middleware('permission:production_division');
        Route::get('/follow_up/index2','StoreController@index2')->name('movements.index')->middleware('permission:all_follow_up');
        Route::get('/follow_up/index_transaction','StoreController@transaction')->name('transaction.index')->middleware('permission:all_follow_up');
        
        Route::get('/transaction/show/{production_order}','StoreController@show')->name('transaction.show');


        Route::get('/follow_up/create', 'StoreController@create')->name('pro_follow_up.create')->middleware('permission:active_order');
        Route::post('/follow_up/store', 'StoreController@store')->name('pro_follow_up.store')->middleware('permission:active_order');
        Route::get('/follow_up/edit/{color}', 'StoreController@edit')->name('pro_follow_up.edit')->middleware('permission:create_transaction');
        Route::put('/follow_up/update/{color}', 'StoreController@update')->name('pro_follow_up.update')->middleware('permission:create_transaction');
        Route::get('/follow_up/xlsx', 'StoreController@Transactionxlsx')->name('transaction.xlsx');
        Route::get('/follow_up/xlsx1', 'StoreController@movementsxlsx')->name('movements.xlsx');
        Route::get('/follow_up/libraxlsx', 'StoreController@activeordersxlsx')->name('activeorders.xlsx');

        Route::get('/follow_up/edit_activeorder/{activeorder}', 'StoreController@edit_activeorder')->name('activeorder.edit');
        Route::put('/follow_up/update_activeorder/{activeorder}', 'StoreController@update_activeorder')->name('activeorder.update');



});