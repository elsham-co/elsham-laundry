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

// Route::prefix('samples')->group(function() {
//     Route::get('/', 'SamplesController@index');
// });
Route::group(['middleware' => ['setLocale','auth']], function () {
    // SamplesController Routes\\
    Route::get('SamplesOrder/', 'SamplesController@index')->name('SamplesOrder.index')->middleware('permission:samples');
    Route::get('/SamplesOrder/create', 'SamplesController@create')->name('SamplesOrder.create')
    ->middleware('permission:create-sampleorder');
    Route::get('/SamplesOrder/viewid_name/{Sampleoder}', 'SamplesController@viewsamplecode')->name('SamplesOrder.samplecode')
    ->middleware('permission:create-sampleorder');
    Route:: post('/SamplesOrder/store', 'SamplesController@store')->name('SamplesOrder.store')->middleware('permission:create-sampleorder');
    Route::get('/SamplesOrder/edit/{Sampleoder}', 'SamplesController@edit')->name('SamplesOrder.edit')->middleware('permission:update-sampleorder');
    Route::put('/SamplesOrder/update/{Sample_order}', 'SamplesController@update')->name('SamplesOrder.update')->middleware('permission:update-sampleorder');
 // الاستلام من المعمل
    Route::put('/SamplesOrder/update/type/{user}', 'confirmSampleTestController@updateType')->name('Fromlab_date.update');
    // ->middleware('receive_from_lab');
// التسليم للعميل
    Route::get('/SamplesOrder/edit_delivery/{Sampleoder}', 'SamplesController@editdelivery')->name('delivery.edit')
    ->middleware('permission:delivery-to-customer');
    Route::put('/SamplesOrder/update/deliver_sample/{Sampleoder}', 'confirmSampleTestController@deliversample')->name('deliver_sample.update')
    ->middleware('permission:delivery-to-customer');
    //حذف رقم عينه
    Route::delete('/SamplesOrder/delete/{Sampleoder}', 'SamplesController@destroy')->name('SamplesOrder.destroy');
    Route::get('/SamplesOrder/deleted_sampleorder', 'SamplesController@deletedsampleorder')->name('SamplesOrder.trashed.index'); 



 // StoreCustomersController Routes\\
    Route:: post('/SamplesOrder/create', 'StoreCustomersController@store')->name('storecustomer');
    Route:: post('/SamplesOrder/create_fabric', 'StoreCustomersController@storeFabric')->name('storefabric');
    
 // SamplesController Routes\\
 Route::get('SamplesCreation/all_test_samples', 'TestSamplesController@index')->name('TestSample.index')->middleware('permission:create-sample');
 Route::post('/SamplesCreation/confirm_testsamplemodal', 'confirmSampleTestController@confirm')->name('TestSample.confirm');
//  ->middleware('permission:create-sample');
//  Route::get('/SamplesCreation/getlab_samplelist', 'TestSamplesController@getlabsamplelist')->name('get.labsample.list');
//عينات بالمعمل
    Route::get('SamplesCreation/all_inlab_samples', 'TestSamplesController@indexinlab')->name('inlabSample.index')->middleware('permission:samples');
    Route::get('/SamplesCreation/edit/{Sample_inlab}', 'TestSamplesController@edit')->name('SamplesCreation.edit') ->middleware('permission:create-sample');
    Route::put('/SamplesCreation/update/{Sample_create}', 'TestSamplesController@update')->name('SamplesCreation.update')
    ->middleware('permission:create-sample');
    Route::get('SamplesCreation/samples_bank', 'TestSamplesController@indexbank')->name('SampleBank.index')->middleware('permission:samples');
    Route::get('/SamplesCreation/edit_sample/{Sample_bank}', 'TestSamplesController@editsamplebank')->name('SampleBank.edit')
    ->middleware('permission:update-sample');
    Route::put('/SamplesCreation/update_sampleinfo/{Sample_info}', 'TestSamplesController@update_sampleinfo')->name('SamplesInfo.update')
    ->middleware('permission:update-sample');

    Route::get('/SamplesCreation/re_edit/{Sample_bank}', 'TestSamplesController@editrecreate')->name('SampleReCreate.edit')
    ->middleware('permission:update-sample');
    Route::put('/SamplesCreation/update_recreate/{Sample_info}', 'TestSamplesController@update_recreate')->name('SamplesReCreate.update')
    ->middleware('permission:update-sample');

    Route::get('/getOptions/{id}', 'TestSamplesController@getOptions')->name('getOptions');


    Route::get('/SamplesCreation/view_sample/{Sample_bank}', 'TestSamplesController@viewsamplebank')->name('SampleBank.view');

});