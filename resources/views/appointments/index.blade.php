<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios del empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Horarios de {{ $employee->name }}</h1>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <a href="{{ route('employees.schedules.create', $employee) }}" class="btn btn-primary mb-3">
                Crear horario
            </a>

            @if ($schedules->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora inicio</th>
                        <th>Hora fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr>
                        <td>
                            @if ($schedule->day_of_week == 0)
                            Domingo
                            @endif

                            @if ($schedule->day_of_week == 1)
                            Lunes
                            @endif

                            @if ($schedule->day_of_week == 2)
                            Martes
                            @endif

                            @if ($schedule->day_of_week == 3)
                            Miércoles
                            @endif

                            @if ($schedule->day_of_week == 4)
                            Jueves
                            @endif

                            @if ($schedule->day_of_week == 5)
                            Viernes
                            @endif

                            @if ($schedule->day_of_week == 6)
                            Sábado
                            @endif
                        </td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>
                            <a href="{{ route('employees.schedules.edit', [$employee, $schedule]) }}"
                                class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('employees.schedules.destroy', [$employee, $schedule]) }}"
                                method="post" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                            <a href="{{ route('employees.schedules.show', [$employee, $schedule]) }}"
                                class="btn btn-info btn-sm">
                                Ver
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Este empleado no tiene horarios creados.</p>
            @endif

            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
</body>

</html>