<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Crear cuenta</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    Revisa los datos introducidos.
                </div>
            @endif

            <form action="{{ route('register') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" id="name" value="{{ old('name') }}">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" id="email" value="{{ old('email') }}">
                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" id="password">
                    @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" class="form-control"
                        name="password_confirmation" id="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Registrarse</button>

                <a href="{{ route('login') }}" class="btn btn-secondary mt-3">
                    Ya tengo cuenta
                </a>
            </form>
        </div>
    </div>
</body>

</html>
