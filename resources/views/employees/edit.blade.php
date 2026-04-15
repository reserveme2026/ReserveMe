<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')
    <div class="container">
        <div class="row">
            <h1>Empleados</h1>
            <form action="{{ route('employees.update', $employee) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                        aria-describedby="name" value="{{ $employee->name }}">
                    @error('name')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="email" id="email"
                        aria-describedby="email" value="{{ $business->email }}">
                    @error('email')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="phone" id="phone"
                        aria-describedby="phone" value="{{ $business->phone }}">
                    @error('phone')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="business_id">Negocio</label>
                    <select class="form-select" name="business_id" id="business_id">
                        @foreach ($businesses as $business)
                            <option value="{{ $business->id }}" {{ old('business_id', $employee->business_id) == $business->id ? 'selected' : '' }}>{{ $business->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Actualizar</button>

            </form>
        </div>
    </div>
</body>

</html>