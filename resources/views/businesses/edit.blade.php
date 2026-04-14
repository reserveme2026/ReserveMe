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
            <form action="{{ route('businesses.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="name" value="{{ $business->name }}">
                    @error('name')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="description" id="description" aria-describedby="description" value="{{ $business->description }}">
                    @error('description')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="phone" id="phone" aria-describedby="phone" value="{{ $business->phone }}">
                    @error('phone')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Direccion</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="address" id="address" aria-describedby="address" value="{{ $business->address }}">
                    @error('address')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="email" id="email" aria-describedby="email" value="{{ $business->email }}">
                    @error('email')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <select name="owner_id" id="">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" value={{ $user->id }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>
</body>

</html>