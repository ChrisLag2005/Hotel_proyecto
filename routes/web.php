<?php

use App\Http\Controllers\HabitacionServicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ReservacionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/bienvenido', function () {
    return view('welcome-hotel');
})->name('welcome.hotel')->middleware('auth');

Route::middleware(['auth'])->group(function () {
  
    Route::get('/habitaciones', [HabitacionController::class, 'index'])->name('habitaciones.index');
    Route::get('/habitaciones-disponibles', [HabitacionController::class, 'index'])->name('habitaciones.disponibles');
    Route::get('/habitaciones/create', [HabitacionController::class, 'create'])->name('habitaciones.create');
    Route::post('/habitaciones', [HabitacionController::class, 'store'])->name('habitaciones.store');
    Route::get('/habitaciones/{habitacion}/edit', [HabitacionController::class, 'edit'])->name('habitaciones.edit');
    Route::put('/habitaciones/{habitacion}', [HabitacionController::class, 'update'])->name('habitaciones.update');
    Route::delete('/habitaciones/{habitacion}', [HabitacionController::class, 'destroy'])->name('habitaciones.destroy');
    
    Route::get('/reservaciones', [ReservacionController::class, 'index'])->name('reservaciones.index');
    Route::get('/reservaciones/create', [ReservacionController::class, 'create'])->name('reservaciones.create');
    Route::post('/reservaciones', [ReservacionController::class, 'store'])->name('reservaciones.store');
    Route::get('/reservaciones/{reservacion}/edit', [ReservacionController::class, 'edit'])->name('reservaciones.edit');
    Route::put('/reservaciones/{reservacion}', [ReservacionController::class, 'update'])->name('reservaciones.update');
    Route::delete('/reservaciones/{reservacion}', [ReservacionController::class, 'destroy'])->name('reservaciones.destroy');

    Route::get('/habitaciones-servicios', [HabitacionServicioController::class, 'index'])->name('habitaciones.servicios.index');
    Route::get('/habitaciones/{habitacion}/servicios', [HabitacionServicioController::class, 'edit'])->name('habitaciones.servicios.edit');
    Route::post('/habitaciones/{habitacion}/servicios', [HabitacionServicioController::class, 'update'])->name('habitaciones.servicios.update');
});