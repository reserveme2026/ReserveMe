<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Servicios de {{ $business->name }}</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('businesses.services.create', $business) }}" class="btn btn-primary mb-3">
                Crear servicio
            </a>

            @if ($services->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Duración</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->duration_minutes }} min</td>
                                <td>{{ $service->price }} €</td>
                                <td>
                                    <a href="{{ route('businesses.services.show', [$business, $service]) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>

                                    <a href="{{ route('businesses.services.edit', [$business, $service]) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('businesses.services.destroy', [$business, $service]) }}"
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
                <p>Este negocio no tiene servicios creados.</p>
            @endif

            <a href="{{ route('businesses.index') }}" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>
</body>

</html>
