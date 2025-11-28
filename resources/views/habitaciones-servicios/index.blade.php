<!DOCTYPE html>
<html>
<head>
    <title>Gestión Habitaciones-Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Habitaciones y Servicios</h1>
        
        {{-- 👇 CONTROL DE ACCESO PARA ADMIN --}}
        @if(auth()->user()->role !== 'admin')
            <div class="alert alert-danger text-center">
                <h4>Acceso Denegado</h4>
                <p>No tienes permisos de administrador para acceder a esta sección.</p>
                <a href="/bienvenido" class="btn btn-primary">Volver al Inicio</a>
            </div>
            @php return; @endphp
        @endif

        {{-- 👇 CONTENIDO SOLO PARA ADMIN --}}
        <div class="row">
            @foreach($habitaciones as $habitacion)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Habitación {{ $habitacion->numero }}</h5>
                        <p class="card-text">
                            <strong>Tipo:</strong> {{ $habitacion->tipo }}<br>
                            <strong>Precio:</strong> ${{ $habitacion->precio }}<br>
                            <strong>Servicios:</strong>
                            <ul>
                                @foreach($habitacion->servicios as $servicio)
                                    <li>{{ $servicio->nombre }} 
                                        @if($servicio->pivot->incluido)
                                            <span class="badge bg-success">Incluido</span>
                                        @else
                                            <span class="badge bg-warning">+${{ $servicio->pivot->precio_extra }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </p>
                        <a href="/habitaciones/{{ $habitacion->id }}/servicios" class="btn btn-primary">
                            Gestionar Servicios
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>