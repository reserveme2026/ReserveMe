<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Negocop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')
    <div class="container">
        <div class="row">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="name" value="{{ old('name') }}">
                    @error('name')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="email" id="email" aria-describedby="email" value="{{ old('email') }}">
                    @error('email')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="password">
                    @error('password')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" aria-describedby="password_confirmation">
                    @error('password_confirmation')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <select name="role">
                    <option value="owner">Propietario</option>
                    <option value="client">Cliente</option>
                </select>

                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>
</body>

</html>