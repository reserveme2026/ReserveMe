<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloqueos del empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Bloqueos de {{ $employee->name }}</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('employees.blockedTimes.create', $employee) }}" class="btn btn-primary mb-3">
                Crear bloqueo
            </a>

            @if ($blockedTimes->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora inicio</th>
                            <th>Hora fin</th>
                            <th>Motivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blockedTimes as $blockedTime)
                            <tr>
                                <td>{{ $blockedTime->date }}</td>
                                <td>{{ $blockedTime->start_time }}</td>
                                <td>{{ $blockedTime->end_time }}</td>
                                <td>{{ $blockedTime->reason }}</td>
                                <td>
                                    <a href="{{ route('employees.blockedTimes.show', [$employee, $blockedTime]) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('employees.blockedTimes.edit', [$employee, $blockedTime]) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('employees.blockedTimes.destroy', [$employee, $blockedTime]) }}"
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
                <p>Este empleado no tiene bloqueos creados.</p>
            @endif

            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
</body>

</html>
