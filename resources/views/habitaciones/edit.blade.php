@extends('layouts.app')

@section('content')
<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Editar Habitación #{{ $habitacion->numero }}</h2>
        <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Habitaciones
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('habitaciones.update', $habitacion) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Número de Habitación *</label>
                    <input type="text" name="numero" class="form-control" value="{{ old('numero', $habitacion->numero) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo *</label>
                    <select name="tipo" class="form-select" required>
                        <option value="">Seleccionar tipo</option>
                        <option value="individual" {{ old('tipo', $habitacion->tipo) == 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="doble" {{ old('tipo', $habitacion->tipo) == 'doble' ? 'selected' : '' }}>Doble</option>
                        <option value="suite" {{ old('tipo', $habitacion->tipo) == 'suite' ? 'selected' : '' }}>Suite</option>
                        <option value="familiar" {{ old('tipo', $habitacion->tipo) == 'familiar' ? 'selected' : '' }}>Familiar</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Capacidad (personas) *</label>
                    <input type="number" name="capacidad" class="form-control" min="1" value="{{ old('capacidad', $habitacion->capacidad) }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Precio por Noche *</label>
                    <input type="number" name="precio" class="form-control" step="0.01" min="0" value="{{ old('precio', $habitacion->precio) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estado *</label>
                    <select name="estado" class="form-select" required>
                        <option value="disponible" {{ old('estado', $habitacion->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="ocupada" {{ old('estado', $habitacion->estado) == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                        <option value="mantenimiento" {{ old('estado', $habitacion->estado) == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                    </select>
                </div>

               
                <div class="mb-3">
                    <label class="form-label">Imagen de la Habitación</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                    
                    @if($habitacion->imagen)
                        <div class="mt-2">
                            <p class="mb-1">Imagen actual:</p>
                            <img src="{{ asset('storage/' . $habitacion->imagen) }}" 
                                 alt="Imagen habitación {{ $habitacion->numero }}" 
                                 class="img-thumbnail" 
                                 style="max-height: 150px;">
                            <div class="form-text">
                                <small>Ruta: {{ $habitacion->imagen }}</small>
                            </div>
                        </div>
                    @else
                        <div class="mt-2">
                            <span class="text-muted">No hay imagen cargada</span>
                        </div>
                    @endif
                    <div class="form-text">Dejar vacío para mantener la imagen actual</div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Actualizar Habitación</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection