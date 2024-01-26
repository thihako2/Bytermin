<?php

use App\Http\Controllers\API\ApiArticlesController;
use App\Http\Controllers\API\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [ApiAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::middleware('is_admin_api')->group(function () {
        Route::post('create/article', [ApiArticlesController::class, 'store']);
    });
});

Route::get('list/articles', [ApiArticlesController::class, 'articles']);
