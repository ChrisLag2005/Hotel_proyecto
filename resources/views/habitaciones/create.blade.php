@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Crear Nueva Habitación</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('habitaciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Número de Habitación *</label>
                    <input type="text" name="numero" class="form-control" value="{{ old('numero') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo *</label>
                    <select name="tipo" class="form-select" required>
                        <option value="">Seleccionar tipo</option>
                        <option value="individual" {{ old('tipo') == 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="doble" {{ old('tipo') == 'doble' ? 'selected' : '' }}>Doble</option>
                        <option value="suite" {{ old('tipo') == 'suite' ? 'selected' : '' }}>Suite</option>
                        <option value="familiar" {{ old('tipo') == 'familiar' ? 'selected' : '' }}>Familiar</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Capacidad (personas) *</label>
                    <input type="number" name="capacidad" class="form-control" min="1" value="{{ old('capacidad') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
    <label class="form-label">Precio por Noche *</label>
    <input type="number" name="precio" class="form-control" step="0.01" min="0" value="{{ old('precio') }}" required>
</div>

                <div class="mb-3">
                    <label class="form-label">Estado *</label>
                    <select name="estado" class="form-select" required>
                        <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="ocupada" {{ old('estado') == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                        <option value="mantenimiento" {{ old('estado') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                    </select>
                </div>

                <!-- CAMPO NUEVO: IMAGEN -->
                <div class="mb-3">
                    <label class="form-label">Imagen de la Habitación</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                    <div class="form-text">Formatos: JPEG, PNG, JPG, GIF. Máx: 2MB</div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Crear Habitación</button>
            <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection