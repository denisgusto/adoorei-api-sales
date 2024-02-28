<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Companies */
Route::get('/companies', [CompanyController::class, 'index'])->name('api.companies.index');
Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('api.companies.show');