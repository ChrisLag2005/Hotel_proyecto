@extends('layouts.app')

@section('content')
<h2>Nueva Habitación</h2>

<div class="card p-4">
    <form action="{{ route('habitaciones.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Número</label>
            <input type="text" class="form-control" name="numero" required>
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <input type="text" class="form-control" name="tipo" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion"></textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" required>
        </div>

        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" class="form-control" name="capacidad" required>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible">Disponible</option>
                <option value="ocupada">Ocupada</option>
                <option value="mantenimiento">Mantenimiento</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
