<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Companies */
Route::get('/companies', [CompanyController::class, 'index'])->name('api.companies.index');
Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('api.companies.show');

/* Products */
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('api.products.show');