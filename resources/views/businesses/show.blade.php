<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle negocio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>{{ $business->name }}</h1>

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

            <div class="card">
                <div class="card-body">
                    <p><strong>Dirección:</strong> {{ $business->address }}</p>
                    <p><strong>Teléfono:</strong> {{ $business->phone }}</p>
                    <p><strong>Email:</strong> {{ $business->email }}</p>
                    <p><strong>Descripción:</strong> {{ $business->description }}</p>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('businesses.index') }}" class="btn btn-secondary">
                    Volver
                </a>

                <a href="{{ route('businesses.appointments.create', $business) }}" class="btn btn-success">
                    Pedir cita
                </a>
            </div>

            @auth
                @if ((auth()->user()->role == 'owner' && $business->owner_id == auth()->id()) || auth()->user()->role == 'admin')
                    <hr>
                    <h3>Panel de administración</h3>

                    <div class="mt-3">
                        <a href="{{ route('businesses.edit', $business) }}" class="btn btn-warning">
                            Editar negocio
                        </a>

                        <a href="{{ route('businesses.employees.index', $business) }}" class="btn btn-primary">
                            Empleados
                        </a>

                        <a href="{{ route('businesses.services.index', $business) }}" class="btn btn-primary">
                            Servicios
                        </a>

                        <a href="{{ route('businesses.appointments.index', $business) }}" class="btn btn-primary">
                            Citas
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</body>

</html>
