<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Crear usuario</h1>

            <form action="{{ route('users.store') }}" method="post">
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

                <div class="form-group">
                    <label for="role">Rol</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="owner" @if (old('role') == 'owner') selected @endif>Owner</option>
                        <option value="client" @if (old('role') == 'client') selected @endif>Client</option>
                    </select>
                    @error('role')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Crear</button>

                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">
                    Volver
                </a>
            </form>
        </div>
    </div>
</body>

</html>
