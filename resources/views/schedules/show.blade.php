<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle horario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Detalle del horario de {{ $employee->name }}</h1>

            <div class="card">
                <div class="card-body">
                    <p>
                        <strong>Día:</strong>

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
                    </p>

                    <p><strong>Hora inicio:</strong> {{ $schedule->start_time }}</p>
                    <p><strong>Hora fin:</strong> {{ $schedule->end_time }}</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('employees.schedules.edit', [$employee, $schedule]) }}" class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('employees.schedules.index', $employee) }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
</body>

</html>
