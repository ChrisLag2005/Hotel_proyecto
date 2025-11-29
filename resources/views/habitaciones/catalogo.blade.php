@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="text-center text-light mb-4">Habitaciones disponibles</h2>

    <div class="row">

        @foreach($habitaciones as $habitacion)
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-light border-secondary shadow">

                    @if($habitacion->archivo)
                        <img src="{{ asset('storage/' . $habitacion->archivo) }}"
                             class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">Habitación {{ $habitacion->numero }}</h5>
                        <p class="card-text">
                            <strong>Tipo:</strong> {{ $habitacion->tipo }} <br>
                            <strong>Precio:</strong> ${{ $habitacion->precio }}
                        </p>

                        <a href="{{ route('habitaciones.mostrar', $habitacion->id) }}" 
                           class="btn btn-primary w-100">
                           Ver detalles
                        </a>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection