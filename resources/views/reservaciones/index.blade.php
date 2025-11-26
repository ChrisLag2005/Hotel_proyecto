@extends('layouts.app')

@section('content')
<div class="container mt-4 text-white">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Reservaciones</h2>
        <a href="{{ route('reservaciones.create') }}" class="btn btn-primary">
            Crear Reservación
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-dark table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Habitación</th>
                <th>Fechas</th>
                <th>Personas</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reservaciones as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>{{ $res->usuario->name }}</td>
                    <td>{{ $res->habitacion->numero }} - {{ $res->habitacion->tipo }}</td>
                    <td>{{ $res->fecha_inicio }} → {{ $res->fecha_fin }}</td>
                    <td>{{ $res->adultos }} adultos, {{ $res->ninos }} niños</td>
                    <td>
                        <span class="badge 
                            @if($res->estado=='pendiente') bg-warning 
                            @elseif($res->estado=='confirmada') bg-success
                            @elseif($res->estado=='cancelada') bg-danger
                            @else bg-secondary @endif">
                            {{ ucfirst($res->estado) }}
                        </span>
                    </td>
                    <td>${{ number_format($res->total, 2) }}</td>

                    <td>
                        <a href="{{ route('reservaciones.edit', $res->id) }}" class="btn btn-sm btn-info">Editar</a>

                        <form action="{{ route('reservaciones.destroy', $res->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar reservación?')">
                                Eliminar
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
