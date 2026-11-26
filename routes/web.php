<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('login', [AuthController::class, 'login'])->middleware(['guest', 'throttle:10,1']);

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', DashboardController::class)->name('admin.dashboard');

        Route::resource('products', ProductController::class)->except('show')->names('admin.products');

        Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::put('orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
        Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    });
});