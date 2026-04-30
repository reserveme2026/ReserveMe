<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Detalle de la cita</h1>

            <div class="card">
                <div class="card-body">
                    <p><strong>Negocio:</strong> {{ $business->name }}</p>
                    <p><strong>Empleado:</strong> {{ $appointment->employee->name }}</p>
                    <p><strong>Servicio:</strong> {{ $appointment->service_name }}</p>
                    <p><strong>Fecha:</strong> {{ $appointment->appointment_date }}</p>
                    <p><strong>Hora inicio:</strong> {{ $appointment->start_time }}</p>
                    <p><strong>Hora fin:</strong> {{ $appointment->end_time }}</p>
                    <p><strong>Estado:</strong> {{ $appointment->status }}</p>
                    <p><strong>Duración:</strong> {{ $appointment->service_duration_minutes }} min</p>
                    <p><strong>Precio:</strong> {{ $appointment->service_price }} €</p>
                    <p><strong>Notas:</strong> {{ $appointment->notes }}</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('businesses.appointments.edit', [$business, $appointment]) }}" class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('businesses.appointments.index', $business) }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
</body>

</html>
