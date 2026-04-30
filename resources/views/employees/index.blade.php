<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Empleados de {{ $business->name }}</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('businesses.employees.create', $business) }}" class="btn btn-primary mb-3">
                Crear empleado
            </a>

            @if ($employees->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <a href="{{ route('businesses.employees.show', [$business, $employee]) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('businesses.employees.edit', [$business, $employee]) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('businesses.employees.destroy', [$business, $employee]) }}"
                                        method="post" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Eliminar
                                        </button>
                                    </form>

                                    <a href="{{ route('employees.schedules.index', $employee) }}"
                                        class="btn btn-primary btn-sm">
                                        Horarios
                                    </a>

                                    <a href="{{ route('employees.blockedTimes.index', $employee) }}"
                                        class="btn btn-secondary btn-sm">
                                        Bloqueos
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Este negocio no tiene empleados creados.</p>
            @endif

            <a href="{{ route('businesses.index') }}" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
</body>

</html>
