@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Habitaciones</h2>
    <a href="{{ route('habitaciones.create') }}" class="btn btn-primary">Nueva habitación</a>
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
            @foreach ($habitaciones as $h)
            <tr>
                <td>{{ $h->id }}</td>
                <td>{{ $h->numero }}</td>
                <td>{{ $h->tipo }}</td>
                <td>${{ $h->precio }}</td>
                <td>{{ $h->capacidad }}</td>
                <td>{{ $h->estado }}</td>

                <td>
                    <a href="{{ route('habitaciones.edit', $h) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('habitaciones.destroy', $h) }}" 
                        method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
