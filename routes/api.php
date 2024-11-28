<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\FavoriteController;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::apiResources([
        '/categories' => CategoryController::class,
        '/products' => ProductController::class,
        '/favorites' => FavoriteController::class
    ]);
    Route::get('/categories/{id}/products', [CategoryProductController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/verify', [AuthController::class, 'verifyEmail']);
