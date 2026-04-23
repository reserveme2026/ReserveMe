<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Detalle usuario</h1>

            <div class="card">
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Rol:</strong> {{ $user->role }}</p>
                    <p><strong>Solicitud owner:</strong> {{ $user->owner_request_status }}</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
</body>

</html>
