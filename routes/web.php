<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

# Index home
Route::get('/', [ProductsController::class, 'index'])->name('home');

# Admin panel
Route::get('/admin', [AdminController::class, 'index'])->name('admin-home');

# Auth view and login method
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth', function () { return view('login'); });

# View and password reset method
Route::get('/lost-password', function () { return view('lost-password'); });
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
