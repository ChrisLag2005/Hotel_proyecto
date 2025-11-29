@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">Lista de Habitaciones</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- BOTÓN SOLO PARA ADMIN - CORREGIDO -->
    <div class="mb-3">
        @if(auth()->user()->es_admin)
            <a href="{{ route('habitaciones.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Habitación
            </a>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Capacidad</th>
                            <th>Precio/Noche</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($habitaciones as $habitacion)
                            <tr>
                                <td>
                                    @if($habitacion->imagen)
                                        <img src="{{ asset('storage/' . $habitacion->imagen) }}" 
                                             alt="Imagen habitación {{ $habitacion->numero }}" 
                                             class="img-thumbnail" 
                                             style="max-height: 80px; max-width: 120px;">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $habitacion->numero }}</td>
                                <td>{{ ucfirst($habitacion->tipo) }}</td>
                                <td class="text-center">{{ $habitacion->capacidad }} personas</td>
                                <td>${{ number_format($habitacion->precio, 2) }}</td>
                                <td>
                                    @php
                                        $badgeClass = [
                                            'disponible' => 'bg-success',
                                            'ocupada' => 'bg-warning text-dark',
                                            'mantenimiento' => 'bg-danger'
                                        ][$habitacion->estado] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($habitacion->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        @if(auth()->user()->es_admin)
                                            <a href="{{ route('habitaciones.edit', $habitacion) }}" 
                                               class="btn btn-warning btn-sm" 
                                               title="Editar habitación">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                        
                                            <form action="{{ route('habitaciones.destroy', $habitacion) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        title="Eliminar habitación"
                                                        onclick="return confirm('¿Estás seguro de eliminar esta habitación?')">
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
    .img-thumbnail {
        object-fit: cover;
    }
</style>
@endsection