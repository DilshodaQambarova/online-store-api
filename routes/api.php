<?php

use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserPaymentCardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CategoryProductController;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::apiResources([
        '/categories' => CategoryController::class,
        '/products' => ProductController::class,
        '/favorites' => FavoriteController::class,
        '/orders' => OrderController::class,
        '/delivery-methods' => DeliveryMethodController::class,
        '/user-payment-cards' => UserPaymentCardController::class,
        '/payment-types' => PaymentTypeController::class,
        '/user-addresses' => UserAddressController::class
    ]);
    Route::get('/categories/{id}/products', [CategoryProductController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/search', [ProductController::class, 'search']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/verify', [AuthController::class, 'verifyEmail']);
