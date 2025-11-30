@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- BOTÓN DE REGRESO -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Gestionar Servicios - Habitación {{ $habitacion->numero }}</h2>
        <a href="{{ route('habitaciones-servicios.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Servicios
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('habitaciones.servicios.update', $habitacion) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Seleccionar Servicios:</label>
                    <div class="row">
                        @foreach($servicios as $servicio)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="servicios[]" 
                                           value="{{ $servicio->id }}"
                                           id="servicio{{ $servicio->id }}"
                                           {{ in_array($servicio->id, $serviciosHabitacion ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="servicio{{ $servicio->id }}">
                                        {{ $servicio->nombre }}
                                        @if($servicio->precio_extra > 0)
                                            <span class="text-success">(+${{ number_format($servicio->precio_extra, 2) }})</span>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Servicios
                    </button>
                    <a href="{{ route('habitaciones-servicios.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection