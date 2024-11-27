<?php

use App\Http\Controllers\CategoryProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    '/categories' => CategoryController::class,
    '/products' => ProductController::class,
    '/categories/{id}/products' => CategoryProductController::class
]);
