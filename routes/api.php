<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'api'], function() {

    Route::group([], function() {
        // Public Routes Here
    });

    Route::group(['middleware' => 'auth'], function() {
        // Private Routes Here
        // Route::middleware('auth:api')->get('/user', function (Request $request) {
        //     return $request->user();
        // });
        // Route::middleware('auth:api')->get('/lang', function (Request $request) {
        //     return $request->user();
        // });
    });
});

// Route::apiResource('/lang', 'App\Http\Controllers\ComputerLanguageController');
