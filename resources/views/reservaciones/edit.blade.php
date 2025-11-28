@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Editar Reservación #{{ $reservacion->id }}</h2>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- CAMBIO IMPORTANTE: Usar $reservacion directamente en la ruta -->
    <form action="{{ route('reservaciones.update', $reservacion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Habitación</label>
            <select name="habitacion_id" class="form-select" required>
                @foreach ($habitaciones as $hab)
                    <option value="{{ $hab->id }}" 
                        {{ $hab->id == $reservacion->habitacion_id ? 'selected' : '' }}>
                        {{ $hab->numero }} - {{ $hab->tipo }} (${{ $hab->precio_noche }}/noche)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" value="{{ $reservacion->fecha_inicio }}" class="form-control" required>
            </div>

            <div class="col mb-3">
                <label class="form-label">Fecha Fin</label>
                <input type="date" name="fecha_fin" value="{{ $reservacion->fecha_fin }}" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Adultos</label>
                <input type="number" name="adultos" class="form-control" min="1" value="{{ $reservacion->adultos }}" required>
            </div>

            <div class="col mb-3">
                <label class="form-label">Niños</label>
                <input type="number" name="ninos" class="form-control" min="0" value="{{ $reservacion->ninos }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
                @foreach (['pendiente','confirmada','cancelada','finalizada'] as $estado)
                    <option value="{{ $estado }}" {{ $reservacion->estado == $estado ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection