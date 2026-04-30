<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Detalle del empleado</h1>

            <div class="card">
                <div class="card-body">
                    <p><strong>Negocio:</strong> {{ $business->name }}</p>
                    <p><strong>Nombre:</strong> {{ $employee->name }}</p>
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $employee->phone }}</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('businesses.employees.edit', [$business, $employee]) }}" class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('employees.schedules.index', $employee) }}" class="btn btn-primary">
                    Horarios
                </a>

                <a href="{{ route('employees.blockedTimes.index', $employee) }}" class="btn btn-secondary">
                    Bloqueos
                </a>

                <a href="{{ route('businesses.employees.index', $business) }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
</body>

</html>
