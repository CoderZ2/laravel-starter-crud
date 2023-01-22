<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InventoryController;
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

Route::get('/', HomeController::class)->name('home')->middleware(['auth.login']);;

Route::prefix('inventory')
    ->name('inventory.')
    ->controller(InventoryController::class)
    ->middleware(['auth.login'])
    ->group(function () {
        Route::get('create', 'create')->name('create');
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('confirm', 'postConfirm')->name('postConfirm');
        Route::get('confirm', 'confirm')->name('confirm');
    });

Route::prefix('auth')
    ->name('auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('login', 'login')->name('login')->middleware(['login']);
        Route::post('login', 'signIn')->name('signIn')->middleware(['login']);
        Route::post('logout', 'logout')->name('logout')->middleware(['auth.login']);
    });

Route::prefix('image')->name('image.')->group(function () {
    Route::post('pre-upload', [ImageController::class, 'preUpload'])->name('preUpload');
});
