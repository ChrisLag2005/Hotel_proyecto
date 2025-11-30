@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="text-center text-light mb-4">Habitaciones disponibles</h2>

    <div class="row">
        @foreach($habitaciones as $habitacion)
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-light border-secondary shadow">
                    
                    {{-- Imagen --}}
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
                            <strong>Precio:</strong> 
                                ${{ number_format($habitacion->precio_por_noche ?? $habitacion->precio, 2) }}
                        </p>

                        <p class="card-text mb-2">
                            <strong>Estado:</strong> 
                            <span class="badge {{ $habitacion->estado == 'disponible' ? 'bg-success' : 'bg-warning' }}">
                                {{ $habitacion->estado }}
                            </span>
                        </p>

                        {{-- Botón detalles para todos --}}
                        <a href="{{ route('habitaciones.mostrar', $habitacion->id) }}" 
                           class="btn btn-primary w-100 mb-2">
                           Ver detalles
                        </a>

                        {{-- SOLO ADMIN --}}
                   @if(auth()->check() && auth()->user()->es_admin)
                            <div class="d-flex flex-column gap-2">

                                {{-- Editar habitación --}}
                                <a href="{{ route('habitaciones.edit', $habitacion->id) }}" 
                                   class="btn btn-warning w-100">
                                    Editar
                                </a>

                                {{-- GESTIONAR SERVICIOS --}}
                                <a href="{{ route('habitaciones.servicios.edit', $habitacion->id) }}" 
                                   class="btn btn-secondary w-100">
                                    Servicios
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('habitaciones.destroy', $habitacion->id) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar esta habitación?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
