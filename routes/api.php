<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Only what the React SHOP needs. The admin dashboard is in routes/web.php.
Route::get('/products', [ProductController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store'])->middleware('throttle:20,1');