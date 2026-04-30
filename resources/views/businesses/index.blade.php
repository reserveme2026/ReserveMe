<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            @auth
            @if (auth()->user()->role == 'owner')
            <h1>Mis negocios</h1>
            @else
            <h1>Negocios</h1>
            @endif
            @else
            <h1>Negocios</h1>
            @endauth

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($businesses->count() > 0)
            @foreach ($businesses as $business)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $business->name }}</h5>

                    <p class="card-text">
                        <strong>Dirección:</strong> {{ $business->address }}
                    </p>

                    <p class="card-text">
                        <strong>Teléfono:</strong> {{ $business->phone }}
                    </p>

                    <p class="card-text">
                        <strong>Email:</strong> {{ $business->email }}
                    </p>

                    <p class="card-text">
                        <strong>Descripción:</strong> {{ $business->description }}
                    </p>

                    <a href="{{ route('businesses.show', $business) }}" class="btn btn-info btn-sm">
                        Ver
                    </a>

                    <a href="{{ route('businesses.appointments.create', $business) }}" class="btn btn-success btn-sm">
                        Pedir cita
                    </a>
                    @auth
                    @if ((auth()->user()->role == 'owner' && $business->owner_id == auth()->id()) || auth()->user()->role == 'admin')
                    <a href="{{ route('businesses.edit', $business) }}" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('businesses.destroy', $business) }}" method="post"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Eliminar
                        </button>
                    </form>

                    <a href="{{ route('businesses.employees.index', $business) }}" class="btn btn-primary btn-sm">
                        Empleados
                    </a>

                    <a href="{{ route('businesses.services.index', $business) }}" class="btn btn-primary btn-sm">
                        Servicios
                    </a>

                    <a href="{{ route('businesses.appointments.index', $business) }}" class="btn btn-primary btn-sm">
                        Citas
                    </a>
                    @endif
                    @endauth
                </div>
            </div>
            @endforeach
            @else
            <p>No hay negocios disponibles.</p>
            @endif
        </div>
    </div>
</body>

</html>