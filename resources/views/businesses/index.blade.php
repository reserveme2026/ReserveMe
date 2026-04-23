<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include("components.header")

    <div class="container mt-4">
        <h2>Negocios</h2>

        @if (session('deleted'))
        <div class="alert alert-success">
            {{ session('deleted') }}
        </div>
        @endif

        <div class="row">
            @foreach ($businesses as $business)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $business->name }}</h5>
                    <p>{{ $business->description }}</p>

                    <a href="{{ route('businesses.show', $business) }}" class="btn btn-info btn-sm">
                        Ver
                    </a>

                    @auth
                    @if (auth()->user()->role == 'client')
                    <a href="{{ route('appointments.create', $business) }}" class="btn btn-success btn-sm">
                        Pedir cita
                    </a>
                    @endif

                    @if (auth()->user()->role == 'admin' || (auth()->user()->role == 'owner' && $business->owner_id == auth()->id()))
                    <a href="{{ route('businesses.edit', $business) }}" class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('businesses.destroy', $business) }}" method="post" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Borrar
                        </button>
                    </form>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="btn btn-success btn-sm">
                        Pedir cita
                    </a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>