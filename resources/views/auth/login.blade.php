<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión | TRULUUNICORNIO 🦄</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-body">
      
    <form method="POST" action="{{ route('login.post') }}" class="shadow p-4">
        @csrf

        <h3 class="display-4">🦄 INICIAR SESIÓN</h3>
        
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
        @endif
  
        <div class="mb-3">
            <label for="user_name" class="form-label">👤 Usuario</label>
            <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="Ingresa tu usuario">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">🔒 Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingresa tu contraseña">
        </div>
        <button type="submit" class="btn btn-primary w-100">✨ Entrar al Sistema</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

