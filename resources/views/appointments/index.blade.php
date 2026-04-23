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

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($appointments->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Negocio</th>
                            <th>Servicio</th>
                            <th>Empleado</th>
                            <th>Fecha</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->business->name }}</td>
                                <td>{{ $appointment->service_name }}</td>
                                <td>{{ $appointment->employee->name }}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->start_time }}</td>
                                <td>{{ $appointment->end_time }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>
                                    <a href="{{ route('appointments.show', $appointment) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('appointments.edit', $appointment) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('appointments.destroy', $appointment) }}"
                                        method="post" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No tienes citas registradas.</p>
            @endif
        </div>
    </div>
</body>

</html>
