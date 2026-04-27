<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Detalle del servicio</h1>

            <div class="card">
                <div class="card-body">
                    <p><strong>Negocio:</strong> {{ $business->name }}</p>
                    <p><strong>Nombre:</strong> {{ $service->name }}</p>
                    <p><strong>Descripción:</strong> {{ $service->description }}</p>
                    <p><strong>Duración:</strong> {{ $service->duration_minutes }} min</p>
                    <p><strong>Precio:</strong> {{ $service->price }} €</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('businesses.services.edit', [$business, $service]) }}" class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('businesses.services.index', $business) }}" class="btn btn-secondary">
                    Volver
                </a>
            </div>
        </div>
    </div>
</body>

</html>
