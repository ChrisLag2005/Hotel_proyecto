@extends('layouts.app') 

@section('content')
<h2 class="text-white">Nueva Habitación</h2>

<div class="card p-4 bg-dark text-white">
    <form action="{{ route('habitaciones.store') }}" method="POST" enctype="multipart/form-data">
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
                <option value="mantenimiento">Mantenimiento</option>
            </select>
        </div>
<div class="mb-3">
    <label>Servicios</label>
    <select class="form-control" name="servicios[]" multiple>
        @foreach($servicios as $serv)
            <option value="{{ $serv->id }}">{{ $serv->nombre }}</option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label class="form-label">Imagen / Archivo</label>
            <input type="file" name="archivo" class="form-control" accept="image/*">
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
