<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle bloqueo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Detalle del bloqueo de {{ $employee->name }}</h1>

            <div class="card">
                <div class="card-body">
                    <p>
                        <strong>Fecha:</strong>
                        {{ $blockedTime->date }}
                    </p>

                    <p>
                        <strong>Hora inicio:</strong>
                        {{ $blockedTime->start_time }}
                    </p>

                    <p>
                        <strong>Hora fin:</strong>
                        {{ $blockedTime->end_time }}
                    </p>

                    <p>
                        <strong>Motivo:</strong>
                        {{ $blockedTime->reason }}
                    </p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('employees.blocked-times.edit', [$employee, $blockedTime]) }}" class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('employees.blocked-times.index', $employee) }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
</body>

</html>
