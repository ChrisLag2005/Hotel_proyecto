<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #000;
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background-color: #111;
            padding: 30px;
            border-radius: 10px;
        }
        .form-control {
            background: #222;
            color: white;
            border: 1px solid #444;
        }
    </style>
</head>
<body>

<div class="card col-md-4">
    <h3 class="text-center mb-3">Crear Cuenta</h3>

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Confirmar contraseña:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Registrarse</button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-info">Ya tengo cuenta</a>
        </div>
    </form>
</div>

</body>
</html>
