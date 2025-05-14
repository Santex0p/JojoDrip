<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home'); });

# Auth view and login method
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth', function () { return view('login'); });

# View and password reset method
Route::get('/lost-password', function () { return view('lost-password'); });
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
