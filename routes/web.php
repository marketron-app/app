<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
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

Route::get('/', IndexController::class);
Route::get("login", [AuthController::class, "index"]);

Route::prefix('image')->group(function () {
    Route::get('', [ImageController::class, 'index'])->name('images.index');
    Route::post('', [ImageController::class, 'store'])->name('images.store');
    Route::get('{image}', [ImageController::class, 'show'])->name('images.show');
});
