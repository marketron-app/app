<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => IsAdminMiddleware::class], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('templates', TemplateController::class);
    Route::post('templates/{template}/publish', [TemplateController::class, 'publish'])->name('templates.publish');
    Route::post('templates/{template}/unpublish', [TemplateController::class, 'unpublish'])->name('templates.unpublish');
    Route::post('templates/{template}/update-template-image', [TemplateController::class, 'updateTemplateImage'])->name('templates.update-template-image');
    Route::post('templates/{template}/update-thumbnail-image', [TemplateController::class, 'updateThumbnailImage'])->name('templates.update-thumbnail-image');
    Route::post('templates/{template}/rerender', [TemplateController::class, 'rerenderThumbnail'])->name('templates.rerender');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('images', [ImageController::class, 'index'])->name('images.index');
});
