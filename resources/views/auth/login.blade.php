<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            background-color: #111;
            border-radius: 10px;
            padding: 30px;
            width: 350px;
        }
        .form-control {
            background-color: #222;
            color: #fff;
            border: 1px solid #444;
        }
        .form-control:focus {
            background-color: #222;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="card">
    <h3 class="text-center mb-4">Iniciar Sesión</h3>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong> {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Entrar</button>

          <div class="text-center mt-3">
            <a href="{{ route('register') }}" class="text-info">Crear una cuenta</a>
        </div>
    </form>
</div>

</body>
</html>
