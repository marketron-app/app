<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name("admin.login");
Route::post('/login', [AuthController::class, 'login']);
Route::delete('/logout', [AuthController::class, 'logout'])->name("admin.logout");

Route::group(['middleware' => IsAdminMiddleware::class], function () {
    Route::get('/', [DashboardController::class, 'index'])->name("admin.dashboard");
    Route::resource("templates", TemplateController::class);
});
