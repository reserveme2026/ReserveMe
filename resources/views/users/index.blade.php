<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Usuarios</h1>

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

            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
                Crear usuario
            </a>

            @if ($users->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Solicitud owner</th>
                            <th>Acciones solicitud</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->owner_request_status }}</td>

                                <td>
                                    @if ($user->owner_request_status == 'pending')
                                        <form action="{{ route('users.approveOwner', $user) }}" method="post"
                                            style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Aceptar
                                            </button>
                                        </form>

                                        <form action="{{ route('users.rejectOwner', $user) }}" method="post"
                                            style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Rechazar
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('users.destroy', $user) }}" method="post"
                                        style="display:inline-block;">
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
                <p>No hay usuarios registrados.</p>
            @endif
        </div>
    </div>
</body>

</html>
