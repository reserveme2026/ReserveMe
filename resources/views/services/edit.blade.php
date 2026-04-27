<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Editar servicio de {{ $business->name }}</h1>

            <form action="{{ route('businesses.services.update', [$business, $service]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" id="name" value="{{ old('name', $service->name) }}">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                        name="description" id="description" value="{{ old('description', $service->description) }}">
                    @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="duration_minutes">Duración (minutos)</label>
                    <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror"
                        name="duration_minutes" id="duration_minutes"
                        value="{{ old('duration_minutes', $service->duration_minutes) }}">
                    @error('duration_minutes')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                        name="price" id="price" value="{{ old('price', $service->price) }}">
                    @error('price')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Actualizar</button>

                <a href="{{ route('businesses.services.index', $business) }}" class="btn btn-secondary mt-3">
                    Volver
                </a>
            </form>
        </div>
    </div>
</body>

</html>
