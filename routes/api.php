<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Order Routes
Route::get('orders',[OrderController::class, 'index']);
Route::post('orders',[OrderController::class, 'store']);
Route::get('orders/{id}',[OrderController::class, 'show']);
Route::get('orders/{id}/edit',[OrderController::class, 'edit']);
Route::put('orders/{id}/edit',[OrderController::class, 'update']);
Route::delete('orders/{id}/delete',[OrderController::class, 'destroy']);

// Product Routes
Route::get('products',[ProductController::class, 'index']);
Route::post('products',[ProductController::class, 'store']);
Route::get('products/{id}',[ProductController::class, 'show']);
Route::get('products/{id}/edit',[ProductController::class, 'edit']);
Route::put('products/{id}/edit',[ProductController::class, 'update']);
Route::delete('products/{id}/delete',[ProductController::class, 'destroy']);

// ProductImage Routes

Route::get('product-images',[ProductImageController::class, 'index']);
Route::post('product-images',[ProductImageController::class, 'store']);
Route::get('product-images/{id}',[ProductImageController::class, 'show']);
Route::get('product-images/{id}/edit',[ProductImageController::class, 'edit']);
Route::put('product-images/{id}/edit',[ProductImageController::class, 'update']);
Route::delete('product-images/{id}/delete',[ProductImageController::class, 'destroy']);

// OrderItem Routes


