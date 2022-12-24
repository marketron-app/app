<?php

use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TemplateController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("templates")->group(function (){
   Route::get("", [TemplateController::class, "index"]);
});

Route::prefix("images")->group(function (){
   Route::post("", [ImageController::class, "store"]);
});

Route::prefix("auth")->group(function(){
    Route::prefix("github")->group(function (){
        Route::get('redirect', [GithubAuthController::class, "redirect"]);
        Route::get('callback', [GithubAuthController::class, "callback"])->name("github-callback");
    });
    Route::prefix("google")->group(function (){
        Route::get('redirect', [GoogleAuthController::class, "redirect"]);
        Route::get('callback', [GoogleAuthController::class, "callback"])->name("google-callback");
    });
});
