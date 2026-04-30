<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Mis citas</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($appointments->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Negocio</th>
                            <th>Empleado</th>
                            <th>Servicio</th>
                            <th>Fecha</th>
                            <th>Hora inicio</th>
                            <th>Hora fin</th>
                            <th>Estado</th>
                            <th>Notas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->business->name }}</td>
                                <td>{{ $appointment->employee->name }}</td>
                                <td>{{ $appointment->service_name }}</td>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->start_time }}</td>
                                <td>{{ $appointment->end_time }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>{{ $appointment->notes }}</td>
                                <td>
                                    <a href="{{ route('businesses.appointments.show', [$appointment->business, $appointment]) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('businesses.appointments.edit', [$appointment->business, $appointment]) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    @if ($appointment->status != 'cancelled')
                                        <form action="{{ route('businesses.appointments.cancel', [$appointment->business, $appointment]) }}"
                                            method="post" style="display:inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Cancelar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No tienes citas registradas.</p>
            @endif

            <a href="{{ route('businesses.index') }}" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
</body>

</html>
