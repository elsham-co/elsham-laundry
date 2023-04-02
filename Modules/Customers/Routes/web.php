<?php


use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UpdateStatusController;
use App\Http\Controllers\CustomersOrdersController;
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
    Route::get('/Customers', 'CustomersController@index')->name('Customers.index')->middleware('permission:customers');
    Route::get('/Customers/create', 'CustomersController@create')->name('Customers.create');
    Route::post('/Customer/store', 'CustomersController@store')->name('Customers.store');
    Route::get('/Customer/edit/{customer}', 'CustomersController@edit')->name('Customers.edit');

    // Route::put('/customer/update/{user}', 'CustomersController@update')->name('customers.update')->middleware('permission:update-customer');
    Route::put('/Customer/update/{customer}', 'CustomersController@update')->name('Customers.update');
    // Route::delete('/customer/delete/{user}', 'CustomersController@destroy')->name('Customers.destroy')->middleware('permission:delete-customer');
    Route::delete('/Customer/delete/{customer}', 'CustomersController@destroy')->name('Customers.destroy');
    Route::get('/Customers/deleted_Color', 'CustomersController@deletedCustomers')->name('Customers.trashed.index');
    Route::get('/Customers/restore/{customer}', 'CustomersController@restoreCustomers')->name('Customers.restore');
    Route::get('/Customers/xlsx', 'CustomersExpertReportController@Customersxlsx')->name('Customers.xlsx')->middleware('permission:print_components');
    Route::get('/Customers/print', 'CustomersController@printCustomers')->name('Customers.print')->middleware('permission:print_components');
});
