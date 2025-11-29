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
  
    Route::resource('habitaciones', HabitacionController::class)->parameters([
        'habitaciones' => 'habitacion'
    ]);
    Route::resource('reservaciones', ReservacionController::class)->parameters([
        'reservaciones' => 'reservacion'
    ]);


    Route::get('/habitaciones-servicios', [HabitacionServicioController::class, 'index'])->name('habitaciones.servicios.index');
    Route::get('/habitaciones/{habitacion}/servicios', [HabitacionServicioController::class, 'edit'])->name('habitaciones.servicios.edit');
    Route::post('/habitaciones/{habitacion}/servicios', [HabitacionServicioController::class, 'update'])->name('habitaciones.servicios.update');
});