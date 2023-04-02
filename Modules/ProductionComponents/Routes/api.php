<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!  components
|
*/

Route::middleware('auth:api')->get('/productioncomponents', function (Request $request) {
    // Route::middleware('auth:api')->get('/productioncomponents', function (Request $request) {
    return $request->user();
});