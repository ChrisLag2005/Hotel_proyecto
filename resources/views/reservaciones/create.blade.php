@extends('layouts.app')

@section('content')
<div class="container mt-4 text-white">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h2 class="fw-bold mb-3">Crear Reservación</h2>

    <form action="{{ route('reservaciones.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Habitación</label>
            <select name="habitacion_id" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach ($habitaciones as $hab)
                    <option value="{{ $hab->id }}">
                        {{ $hab->numero }} - {{ $hab->tipo }} (${{ $hab->precio_noche }}/noche)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>

            <div class="col mb-3">
                <label class="form-label">Fecha Fin</label>
                <input type="date" name="fecha_fin" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Adultos</label>
                <input type="number" name="adultos" class="form-control" min="1" required>
            </div>

            <div class="col mb-3">
                <label class="form-label">Niños</label>
                <input type="number" name="ninos" class="form-control" min="0" value="0">
            </div>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary">Volver</a>

    </form>

</div>
@endsection
