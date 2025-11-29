@extends('layouts.app')

@section('content')
<div class="container mt-5">
   
    <div class="mb-4">
        <a href="{{ route('habitaciones.catalogo') }}" class="btn btn-secondary">
            ← Volver al Catálogo
        </a>
    </div>

    <div class="card bg-dark text-light border-secondary shadow">
        
        @if($habitacion->imagen)
            <img src="{{ asset('storage/' . $habitacion->imagen) }}" 
                 class="card-img-top" 
                 alt="Habitación {{ $habitacion->numero }}"
                 style="height: 400px; object-fit: cover;">
        @else
            <img src="https://via.placeholder.com/800x400/333/fff?text=Habitación+{{ $habitacion->numero }}" 
                 class="card-img-top"
                 alt="Habitación {{ $habitacion->numero }}"
                 style="height: 400px; object-fit: cover;">
        @endif

        <div class="card-body">
            <h2>Habitación {{ $habitacion->numero }}</h2>

           
            <div class="mb-3">
                <span class="badge bg-primary">{{ $habitacion->tipo }}</span>
                <span class="badge {{ $habitacion->estado == 'disponible' ? 'bg-success' : 'bg-warning' }}">
                    {{ $habitacion->estado }}
                </span>
            </div>

            
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Capacidad:</strong> {{ $habitacion->capacidad }} personas</p>
                    <p><strong>Estado:</strong> {{ $habitacion->estado }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Precio por noche:</strong> 
                        ${{ number_format($habitacion->precio_por_noche ?? $habitacion->precio, 2) }}
                    </p>
                    @if($habitacion->tamano)
                        <p><strong>Tamaño:</strong> {{ $habitacion->tamano }} m²</p>
                    @endif
                </div>
            </div>

            
            @if($habitacion->descripcion)
                <p><strong>Descripción:</strong> {{ $habitacion->descripcion }}</p>
            @endif

          
            <div class="mt-4">
                <h5>Servicios:</h5>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($habitacion->servicios as $servicio)
                        <span class="badge bg-info fs-6">
                            {{ $servicio->nombre }}
                            @if(isset($servicio->pivot->precio_extra) && $servicio->pivot->precio_extra > 0)
                                (+${{ number_format($servicio->pivot->precio_extra, 2) }})
                            @endif
                        </span>
                    @empty
                        <span class="text-muted">No hay servicios disponibles</span>
                    @endforelse
                </div>
            </div>

            <div class="mt-4">
                @if(auth()->check() && auth()->user()->rol === 'cliente' && $habitacion->estado == 'disponible')
                    <a href="{{ route('reservaciones.create', ['habitacion_id' => $habitacion->id]) }}" 
                       class="btn btn-success btn-lg">
                        Reservar esta habitación
                    </a>
                @elseif($habitacion->estado != 'disponible')
                    <button class="btn btn-secondary btn-lg" disabled>
                        Habitación no disponible
                    </button>
                @elseif(!auth()->check())
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                        Iniciar sesión para reservar
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection