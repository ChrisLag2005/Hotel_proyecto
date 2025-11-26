<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Mostrar formulario login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Procesar login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
