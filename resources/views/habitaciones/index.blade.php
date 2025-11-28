@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Habitaciones</h2>
    <a href="{{ url('/habitaciones/create') }}" class="btn btn-primary">Nueva habitación</a>
</div>

<div class="card p-3">
    <table class="table table-dark table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($habitaciones as $habitacion)
                <tr>
                    <td>{{ $habitacion->id }}</td>
                    <td>{{ $habitacion->numero }}</td>
                    <td>{{ $habitacion->tipo }}</td>
                    <td>${{ $habitacion->precio }}</td>
                    <td>{{ $habitacion->capacidad }}</td>
                    <td>
                        <span class="badge bg-{{ $habitacion->estado == 'disponible' ? 'success' : 'danger' }}">
                            {{ ucfirst($habitacion->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ url('/habitaciones/' . $habitacion->id . '/edit') }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ url('/habitaciones/' . $habitacion->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar habitación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection