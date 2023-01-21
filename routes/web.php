<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\StoreController;
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

session()->forget('base64Images');
Route::get('/', HomeController::class)->name('home');
Route::prefix('store')->name('store.')->controller(StoreController::class)->group(function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::post('confirm', 'postConfirm')->name('postConfirm');
    Route::get('confirm', 'confirm')->name('confirm');
});

Route::prefix('image')->name('image')->group(function () {
    Route::post('pre-upload', [ImageController::class, 'preUpload'])->name('preUpload');
});
