<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Citas de {{ $business->name }}</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (auth()->user()->role == 'client')
                <a href="{{ route('businesses.appointments.create', $business) }}" class="btn btn-primary mb-3">
                    Pedir cita
                </a>
            @endif

            @if ($appointments->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
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
                                <td>{{ $appointment->employee->name }}</td>
                                <td>{{ $appointment->service_name }}</td>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->start_time }}</td>
                                <td>{{ $appointment->end_time }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>{{ $appointment->notes }}</td>
                                <td>
                                    <a href="{{ route('businesses.appointments.show', [$business, $appointment]) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('businesses.appointments.edit', [$business, $appointment]) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    @if ((auth()->user()->role == 'owner' || auth()->user()->role == 'admin') && $appointment->status == 'pending')
                                        <form action="{{ route('businesses.appointments.confirm', [$business, $appointment]) }}"
                                            method="post" style="display:inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Aceptar
                                            </button>
                                        </form>

                                        <form action="{{ route('businesses.appointments.reject', [$business, $appointment]) }}"
                                            method="post" style="display:inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Rechazar
                                            </button>
                                        </form>
                                    @endif

                                    @if (auth()->user()->role == 'client' && $appointment->status != 'cancelled')
                                        <form action="{{ route('businesses.appointments.cancel', [$business, $appointment]) }}"
                                            method="post" style="display:inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Cancelar
                                            </button>
                                        </form>
                                    @endif

                                    @if (auth()->user()->role == 'admin' || (auth()->user()->role == 'owner' && $business->owner_id == auth()->id()))
                                        <form action="{{ route('businesses.appointments.destroy', [$business, $appointment]) }}"
                                            method="post" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-dark btn-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay citas registradas para este negocio.</p>
            @endif

            <a href="{{ route('businesses.show', $business) }}" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
</body>

</html>
