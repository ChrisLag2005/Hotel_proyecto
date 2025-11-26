@extends('layouts.app')

@section('content')
<div class="container mt-4 text-white">

    <h2 class="fw-bold mb-3">Editar Reservación #{{ $res->id }}</h2>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('reservaciones.update', $res->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Habitación</label>
            <select name="habitacion_id" class="form-select" required>
                @foreach ($habitaciones as $hab)
                    <option value="{{ $hab->id }}" 
                        {{ $hab->id == $res->habitacion_id ? 'selected' : '' }}>
                        {{ $hab->numero }} - {{ $hab->tipo }} (${{ $hab->precio_noche }}/noche)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" value="{{ $res->fecha_inicio }}" class="form-control" required>
            </div>

            <div class="col mb-3">
                <label class="form-label">Fecha Fin</label>
                <input type="date" name="fecha_fin" value="{{ $res->fecha_fin }}" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Adultos</label>
                <input type="number" name="adultos" class="form-control" min="1" value="{{ $res->adultos }}" required>
            </div>

            <div class="col mb-3">
                <label class="form-label">Niños</label>
                <input type="number" name="ninos" class="form-control" min="0" value="{{ $res->ninos }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
                @foreach (['pendiente','confirmada','cancelada','finalizada'] as $estado)
                    <option value="{{ $estado }}" {{ $res->estado == $estado ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>

</div>
@endsection
