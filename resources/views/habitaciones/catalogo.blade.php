@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-light mb-4">Habitaciones disponibles</h2>

    <div class="row">
        @foreach($habitaciones as $habitacion)
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-light border-secondary shadow">
                    
                    @if($habitacion->imagen)
                        <img src="{{ asset('storage/' . $habitacion->imagen) }}"
                             class="card-img-top" 
                             alt="Habitación {{ $habitacion->numero }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200/333/fff?text=Habitación+{{ $habitacion->numero }}" 
                             class="card-img-top"
                             alt="Habitación {{ $habitacion->numero }}"
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">Habitación {{ $habitacion->numero }}</h5>
                        <p class="card-text">
                            <strong>Tipo:</strong> {{ $habitacion->tipo }} <br>
                            <strong>Precio:</strong> ${{ number_format($habitacion->precio_por_noche ?? $habitacion->precio, 2) }}
                        </p>

                       
                        <p class="card-text">
                            <strong>Estado:</strong> 
                            <span class="badge {{ $habitacion->estado == 'disponible' ? 'bg-success' : 'bg-warning' }}">
                                {{ $habitacion->estado }}
                            </span>
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