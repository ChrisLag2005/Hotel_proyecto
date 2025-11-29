@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Lista de Reservaciones</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('reservaciones.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Reservación
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Habitación</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Adultos</th>
                            <th>Niños</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservaciones as $reservacion)
                            <tr>
                                <td class="fw-bold">{{ $reservacion->id }}</td>
                                <td>
                                    @if($reservacion->habitacion)
                                        <strong>{{ $reservacion->habitacion->numero }}</strong> - 
                                        {{ $reservacion->habitacion->tipo }}
                                    @else
                                        <span class="text-warning">N/A</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($reservacion->fecha_inicio)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservacion->fecha_fin)->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $reservacion->adultos }}</td>
                                <td class="text-center">{{ $reservacion->ninos ?? 0 }}</td>
                                <td>
                                    @php
                                        $badgeClass = [
                                            'pendiente' => 'bg-warning text-dark',
                                            'confirmada' => 'bg-success',
                                            'finalizada' => 'bg-info',
                                            'cancelada' => 'bg-danger'
                                        ][$reservacion->estado] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($reservacion->estado) }}
                                    </span>
                                </td>
                                <td class="fw-bold">${{ number_format($reservacion->total, 2) }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <!-- Botón Editar - SOLO ADMIN -->
                                        @if(auth()->user()->es_admin)
                                            <a href="{{ route('reservaciones.edit', $reservacion) }}" 
                                               class="btn btn-warning btn-sm" 
                                               title="Editar reservación">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                        @endif
        
                                        <!-- Botón Eliminar - SOLO ADMIN -->
                                        @if(auth()->user()->es_admin)
                                            <form action="{{ route('reservaciones.destroy', $reservacion) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        title="Eliminar reservación"
                                                        onclick="return confirm('¿Estás seguro de eliminar esta reservación?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        background-color: #343a40;
        color: white;
        border-bottom: 2px solid #dee2e6;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .badge {
        font-size: 0.875em;
    }
</style>
@endsection