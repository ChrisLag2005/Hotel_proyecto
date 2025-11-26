<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ReservacionController;

// Página principal al iniciar sesión
Route::get('/', function () {
    return redirect()->route('reservaciones.index');
})->middleware('auth');

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para probar autenticación
Route::get('/dashboard', function () {
    return "Bienvenido, estás logueado!";
})->middleware('auth');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {

    // CRUD Habitaciones
    Route::resource('habitaciones', HabitacionController::class);

    // CRUD Reservaciones
    Route::resource('reservaciones', ReservacionController::class);
});
