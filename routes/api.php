<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
Route::group([], function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::delete('products/{id}', [ProductController::class, 'destroy']);
        Route::post('products', [ProductController::class, 'store']);
        Route::put('products/{id}', [ProductController::class, 'update']);
        Route::post('logout', [LoginController::class, 'logout']);

    });
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('login', [LoginController::class, 'login']);
});
