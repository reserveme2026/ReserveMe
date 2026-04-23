<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear bloqueo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Crear bloqueo para {{ $employee->name }}</h1>

            <form action="{{ route('employees.blockedTimes.store', $employee) }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="date">Fecha</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                        name="date" id="date" value="{{ old('date') }}">
                    @error('date')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="start_time">Hora inicio</label>
                    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                        name="start_time" id="start_time" value="{{ old('start_time') }}">
                    @error('start_time')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="end_time">Hora fin</label>
                    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                        name="end_time" id="end_time" value="{{ old('end_time') }}">
                    @error('end_time')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="reason">Motivo</label>
                    <input type="text" class="form-control @error('reason') is-invalid @enderror"
                        name="reason" id="reason" value="{{ old('reason') }}">
                    @error('reason')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Crear</button>

                <a href="{{ route('employees.blockedTimes.index', $employee) }}" class="btn btn-secondary mt-3">
                    Volver
                </a>
            </form>
        </div>
    </div>
</body>

</html>
