<!DOCTYPE html>
<html>
<head>
    <title>Editar Servicios - Habitación {{ $habitacion->numero }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestionar Servicios - Habitación {{ $habitacion->numero }}</h1>
        
        <form method="POST" action="{{ route('habitaciones.servicios.update', $habitacion) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <h4>Seleccionar Servicios:</h4>
                @foreach($servicios as $servicio)
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" 
                           name="servicios[]" 
                           value="{{ $servicio->id }}"
                           id="servicio{{ $servicio->id }}"
                           {{ in_array($servicio->id, $serviciosHabitacion) ? 'checked' : '' }}>
                    <label class="form-check-label" for="servicio{{ $servicio->id }}">
                        <strong>{{ $servicio->nombre }}</strong> - ${{ $servicio->precio_adicional }}
                    </label>
                    
                    <div class="ms-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" 
                                   name="incluido_{{ $servicio->id }}"
                                   id="incluido{{ $servicio->id }}">
                            <label class="form-check-label" for="incluido{{ $servicio->id }}">
                                Incluido en el precio
                            </label>
                        </div>
                        <div class="input-group input-group-sm mt-1" style="width: 200px;">
                            <span class="input-group-text">Precio extra: $</span>
                            <input type="number" class="form-control" 
                                   name="precio_extra_{{ $servicio->id }}"
                                   value="0" step="0.01" min="0">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('habitaciones-servicios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>