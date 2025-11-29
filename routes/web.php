<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ReservacionController;

// Página principal al iniciar sesión
Route::get('/bienvenido', function () {
    return view('welcome-hotel');
})->name('welcome.hotel')->middleware('auth');

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Catálogo visible para clientes y empleados
Route::get('/habitaciones-disponibles', [HabitacionController::class, 'catalogo'])->name('habitaciones.catalogo');

// Ver detalle de una habitación
Route::get('/habitaciones/{id}/ver', [HabitacionController::class, 'mostrar'])->name('habitaciones.mostrar');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {

  Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::resource('habitaciones', HabitacionController::class);
});

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::resource('reservaciones', ReservacionController::class);
});

});
