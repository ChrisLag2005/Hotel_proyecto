@extends('layouts.app')

@section('content')
<h2>Editar Habitación</h2>

<div class="card p-4">
    <form action="{{ route('habitaciones.update', $habitacion) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Número</label>
            <input type="text" class="form-control" name="numero" value="{{ $habitacion->numero }}" required>
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <input type="text" class="form-control" name="tipo" value="{{ $habitacion->tipo }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion">{{ $habitacion->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" value="{{ $habitacion->precio }}" required>
        </div>

        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" class="form-control" name="capacidad" value="{{ $habitacion->capacidad }}" required>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible" {{ $habitacion->estado=='disponible'?'selected':'' }}>Disponible</option>
                <option value="ocupada" {{ $habitacion->estado=='ocupada'?'selected':'' }}>Ocupada</option>
                <option value="mantenimiento" {{ $habitacion->estado=='mantenimiento'?'selected':'' }}>Mantenimiento</option>
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
