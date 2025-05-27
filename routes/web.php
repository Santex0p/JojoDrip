<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    # Admin panel
    Route::get('/admin', [AdminController::class, 'index'])->name('admin-home');
    # Products
    Route::post('/add-product', [ProductsController::class, 'add'])->name('products');
    Route::get('/products', function () {return view('add-product');})->name('product');
    Route::get('/remove-product', [ProductsController::class, 'delete'])->name('delete-product');
    Route::post('/update-product', [ProductsController::class, 'update'])->name('update-product');
    Route::get('/edit-view' , [ProductsController::class, 'editView'])->name('edit-product');
    Route::post('/change-status' , [BasketController::class, 'changeStatus'])->name('change-status');
});

# Index home
Route::get('/', [ProductsController::class, 'index'])->name('home');

# Basket
Route::get('/basket', [BasketController::class, 'index'])->name('basket');
Route::get('/add-to-basket', [BasketController::class, 'addToBasket'])->name('add-to-basket');
Route::get('/remove-basket', [BasketController::class, 'removeFromBasket'])->name('remove-basket');
Route::get('/remove-all', [BasketController::class, 'removeAll'])->name('remove-all');
Route::post('/buy', [BasketController::class, 'buy'])->name('buy');

# Public product
Route::get('/product/{product}/{action}', [ProductsController::class, 'details'])->name('detail-product');

# Auth
Route::post('/auth', [AuthController::class, 'login'])->name('auth');
Route::get('/login', function () { return view('login'); })->name('login'); # View login
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

# View and password reset method
Route::get('/lost-password', function () { return view('lost-password'); });
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
