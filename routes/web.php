<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    # Admin panel
    Route::get('/admin', [AdminController::class, 'index'])->name('admin-home');
    # Products
    Route::post('/add-product', [ProductsController::class, 'add'])->name('products');
    Route::get('/products', function () {return view('add-product');})->name('product');
    Route::post('/remove-product', [ProductsController::class, 'delete'])->name('delete-product');
});

# Index home
Route::get('/', [ProductsController::class, 'index'])->name('home');



# Auth
Route::post('/auth', [AuthController::class, 'login'])->name('auth');
Route::get('/login', function () { return view('login'); })->name('login'); # View login
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



# View and password reset method
Route::get('/lost-password', function () { return view('lost-password'); });
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
