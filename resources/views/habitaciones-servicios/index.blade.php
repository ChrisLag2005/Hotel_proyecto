<!DOCTYPE html>
<html>
<head>
    <title>Gestión Habitaciones-Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Habitaciones y Servicios</h1>
        
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
                        <a href="{{ route('habitaciones.servicios.edit', $habitacion) }}" class="btn btn-primary">
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