<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\HabitacionServicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('home');

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Público
Route::get('/habitaciones-catalogo', [HabitacionController::class, 'catalogo'])
    ->name('habitaciones.catalogo');

// Privado
Route::middleware('auth')->group(function () {

    Route::get('/bienvenido', fn() => view('welcome-hotel'))->name('welcome.hotel');

    Route::resource('habitaciones', HabitacionController::class)
        ->parameters(['habitaciones' => 'habitacion'])
        ->except('show');

    Route::resource('reservaciones', ReservacionController::class)
    ->parameters(['reservaciones' => 'reservacion']);


    Route::get('/habitaciones/{habitacion}/servicios', 
        [HabitacionServicioController::class, 'edit'])->name('habitaciones.servicios.edit');

    Route::post('/habitaciones/{habitacion}/servicios', 
        [HabitacionServicioController::class, 'update'])->name('habitaciones.servicios.update');

     Route::get('/habitaciones-servicios', [HabitacionServicioController::class, 'index'])
    ->name('habitaciones-servicios.index');
});

// Ruta pública con parámetro
Route::get('/habitaciones/{habitacion}', [HabitacionController::class, 'mostrar'])
    ->name('habitaciones.mostrar');
