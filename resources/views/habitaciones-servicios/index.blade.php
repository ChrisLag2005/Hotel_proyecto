@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Gestión de Servicios por Habitación</h2>
        <a href="{{ route('habitaciones.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Habitaciones
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
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Habitación</th>
                            <th>Tipo</th>
                            <th>Servicios Asignados</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($habitaciones as $habitacion)
                            <tr>
                                <td class="fw-bold">{{ $habitacion->numero }}</td>
                                <td>{{ ucfirst($habitacion->tipo) }}</td>
                                <td>
                                    @if($habitacion->servicios->count() > 0)
                                        @foreach($habitacion->servicios as $servicio)
                                            <span class="badge bg-primary me-1">
                                                {{ $servicio->nombre }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Sin servicios asignados</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('habitaciones.servicios.edit', $habitacion) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-cog"></i> Gestionar Servicios
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection