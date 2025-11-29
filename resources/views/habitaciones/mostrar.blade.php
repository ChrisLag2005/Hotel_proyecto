@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="card bg-dark text-light border-secondary shadow">

        @if($habitacion->archivo)
            <img src="{{ asset('storage/' . $habitacion->archivo) }}" 
                 class="card-img-top" style="height: 300px; object-fit: cover;">
        @endif

        <div class="card-body">
            <h2>Habitación {{ $habitacion->numero }}</h2>

            <p><strong>Tipo:</strong> {{ $habitacion->tipo }}</p>
            <p><strong>Capacidad:</strong> {{ $habitacion->capacidad }} personas</p>
            <p><strong>Estado:</strong> {{ $habitacion->estado }}</p>
            <p><strong>Descripción:</strong> {{ $habitacion->descripcion }}</p>
            <p><strong>Precio por noche:</strong> ${{ $habitacion->precio }}</p>

            <p><strong>Servicios:</strong>
            @foreach($habitacion->servicios as $ser)
                <span class="badge bg-info">{{ $ser->nombre }}</span>
            @endforeach
            </p>

            @if(auth()->user()->rol === 'cliente')
                <a href="{{ route('reservaciones.create') }}" class="btn btn-success">
                    Reservar esta habitación
                </a>
            @endif
        </div>
    </div>

</div>
@endsection

