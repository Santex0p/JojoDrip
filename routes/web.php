<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('login'); });


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', function () { return view('home'); });

# View and password reset method
Route::get('/lost-password', function () { return view('lost-password'); });
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
