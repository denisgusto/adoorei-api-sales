<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Companies */
Route::get('/companies', [CompanyController::class, 'index'])->name('api.companies.index');
Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('api.companies.show');

/* Products */
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('api.products.show');

/* Sales */
Route::get('/sales', [SaleController::class, 'index'])->name('api.sales.index');
Route::get('/sales/{id}', [SaleController::class, 'show'])->name('api.sales.show');
Route::post('/sales', [SaleController::class, 'store'])->name('api.sales.store');
Route::put('/sales/{id}', [SaleController::class, 'update'])->name('api.sales.update');
Route::delete('/sales/{id}', [SaleController::class, 'cancel'])->name('api.sales.cancel');