<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')
    <div class="container">
        <div class="row">
            <h1>Crear servicio</h1>
            <form action="{{ route('services.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="name" value="{{ old('name') }}">
                    @error('name')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="description" id="description" aria-describedby="description" value="{{ old('description') }}">
                    @error('description')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="duration_minutes">Duración</label>
                    <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" name="duration_minutes" id="duration_minutes" aria-describedby="duration_minutes" value="{{ old('duration_minutes') }}">
                    @error('duration_minutes')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" aria-describedby="price" value="{{ old('price') }}">
                    @error('price')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <select name="business_id" id="">
                    @foreach ($businesses as $business)
                    <option value="{{ $business->id }}">{{ $business->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>
</body>

</html>