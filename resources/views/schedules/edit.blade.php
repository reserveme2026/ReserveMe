<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar horario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Editar horario de {{ $employee->name }}</h1>

            <form action="{{ route('employees.schedules.update', [$employee, $schedule]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="day_of_week">Día de la semana</label>
                    <select name="day_of_week" id="day_of_week"
                        class="form-control @error('day_of_week') is-invalid @enderror">
                        <option value="">Selecciona un día</option>
                        <option value="0" @if (old('day_of_week', $schedule->day_of_week) == 0) selected @endif>Domingo</option>
                        <option value="1" @if (old('day_of_week', $schedule->day_of_week) == 1) selected @endif>Lunes</option>
                        <option value="2" @if (old('day_of_week', $schedule->day_of_week) == 2) selected @endif>Martes</option>
                        <option value="3" @if (old('day_of_week', $schedule->day_of_week) == 3) selected @endif>Miércoles</option>
                        <option value="4" @if (old('day_of_week', $schedule->day_of_week) == 4) selected @endif>Jueves</option>
                        <option value="5" @if (old('day_of_week', $schedule->day_of_week) == 5) selected @endif>Viernes</option>
                        <option value="6" @if (old('day_of_week', $schedule->day_of_week) == 6) selected @endif>Sábado</option>
                    </select>
                    @error('day_of_week')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="start_time">Hora inicio</label>
                    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                        name="start_time" id="start_time" value="{{ old('start_time', $schedule->start_time) }}">
                    @error('start_time')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="end_time">Hora fin</label>
                    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                        name="end_time" id="end_time" value="{{ old('end_time', $schedule->end_time) }}">
                    @error('end_time')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Actualizar</button>

                <a href="{{ route('employees.schedules.index', $employee) }}" class="btn btn-secondary mt-3">
                    Volver
                </a>
            </form>
        </div>
    </div>
</body>

</html>
