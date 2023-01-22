<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
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
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('/', IndexController::class);

Route::prefix('image')->group(function () {
    Route::get('', [ImageController::class, 'index'])->name('images.index');
    Route::post('', [ImageController::class, 'store'])->name('images.store');
    Route::get('{image}', [ImageController::class, 'show'])->name('images.show');
});

Route::prefix('auth')->group(function () {
    Route::prefix('github')->group(function () {
        Route::get('redirect', [GithubAuthController::class, 'redirect'])->name('github-redirect');
        Route::get('callback', [GithubAuthController::class, 'callback'])->name('github-callback');
    });
    Route::prefix('google')->group(function () {
        Route::get('redirect', [GoogleAuthController::class, 'redirect'])->name('google-redirect');
        Route::get('callback', [GoogleAuthController::class, 'callback'])->name('google-callback');
    });
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('images', [UserController::class, 'images'])->name('user.images');
    });
});
