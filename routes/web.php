<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnsplashController;

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

Route::controller(UnsplashController::class)->group(function () {
    Route::get('/', 'home')->name('homepage');
    Route::get('/artist/{artistId}', 'artistDetail')->name('artistDetail');
    Route::get('/photo/{photoId}', 'photoDetail')->name('photoDetail');
});