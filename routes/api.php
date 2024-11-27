<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResources([
        '/categories' => CategoryController::class,
        '/products' => ProductController::class,
        '/categories/{id}/products' => CategoryProductController::class
    ]);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/verify', [AuthController::class, 'verifyEmail']);
