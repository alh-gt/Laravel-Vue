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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/portal', [App\Http\Controllers\PortalController::class, 'index'])->name('portal');
    Route::get('/lang',[App\Http\Controllers\ComputerLanguageController::class, 'index'])->name('lang');
    Route::get('/lang/{id}',[App\Http\Controllers\ComputerLanguageController::class, 'show'])->name('lang');
    Route::post('/lang',[App\Http\Controllers\ComputerLanguageController::class, 'store'])->name('lang');
    Route::put('/lang/{id}',[App\Http\Controllers\ComputerLanguageController::class, 'update'])->name('lang');
    Route::delete('/lang/{id}',[App\Http\Controllers\ComputerLanguageController::class, 'destroy'])->name('lang');
});

// Route::get('/portal', function () {
//     return view('portal');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
