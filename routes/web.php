<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');

Route::get('/admin/products', [HomeController::class, 'admin'])->name('admin');
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    //TODO Подключить проверку
 //   Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('products', [AdminController::class, 'products']);
        Route::get('products/create', [AdminController::class, 'create']);
        Route::get('products/{id}', [AdminController::class, 'show']);
        Route::get('products/{id}/edit', [AdminController::class, 'edit']);

//    });
});
