@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="text-center mb-5">
        <h1 class="display-4 text-light">🏨 Bienvenido al Hotel</h1>
        <p class="text-secondary">Hola <strong>{{ auth()->user()->name }}</strong>, nos alegra tenerte aquí.</p>
    </div>

    <div class="row justify-content-center">

        {{-- 🔹 BOTÓN PARA VER HABITACIONES (VISIBLE PARA TODOS LOS ROLES) --}}
        <div class="col-md-6 mb-4">
            <div class="card bg-dark text-light shadow-lg border-secondary">
                <div class="card-body text-center">
                    <h3>Habitaciones disponibles</h3>
                    <p>Explora las habitaciones registradas y ve sus detalles.</p>
                    <a href="{{ route('habitaciones.catalogo') }}" class="btn btn-info">
                        Ver catálogo de habitaciones
                    </a>
                </div>
            </div>
        </div>

        {{-- TARJETA PARA CLIENTES --}}
        @if(auth()->user()->rol === 'cliente')
            <div class="col-md-6">
                <div class="card bg-dark text-light shadow-lg border-secondary">
                    <div class="card-body text-center">
                        <h3>Reservar habitación</h3>
                        <p>Consulta disponibilidad y realiza una reservación.</p>
                        <a href="{{ route('reservaciones.create') }}" class="btn btn-primary">Crear reservación</a>
                        <a href="{{ route('reservaciones.index') }}" class="btn btn-outline-light mt-2">Mis reservaciones</a>
                    </div>
                </div>
            </div>
        @endif

        {{-- TARJETA PARA EMPLEADOS --}}
        @if(auth()->user()->rol === 'empleado')
            <div class="col-md-6">
                <div class="card bg-dark text-light shadow-lg border-secondary">
                    <div class="card-body text-center">
                        <h3>Administrar habitaciones</h3>
                        <p>Registrar nuevas habitaciones o editar las existentes.</p>
                        <a href="{{ route('habitaciones.create') }}" class="btn btn-success">Registrar habitación</a>
                        <a href="{{ route('habitaciones.index') }}" class="btn btn-outline-light mt-2">Ver habitaciones</a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
