<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel - Reservaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #000; color: #ddd; }
        .card { background-color: #111; border: 1px solid #333; }
        a, a:hover { color: #0d6efd; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome.hotel') }}">Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#menu" aria-controls="menu" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('habitaciones.index') }}">Habitaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservaciones.index') }}">Reservaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('habitaciones.catalogo') }}">Catálogo</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('habitaciones.index') }}">Habitaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservaciones.index') }}">Mis Reservas</a>
                        </li>
                    @endif
                @endauth
            </ul>

            @auth
                <form method="POST" action="{{ route('logout') }}" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Salir</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
