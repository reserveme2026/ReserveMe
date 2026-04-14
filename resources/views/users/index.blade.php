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
        <h2>Panel administración - Usuarios</h2>

        @if (session('deleted'))
        <div class="alert alert-success">
            {{ session('deleted') }}
        </div>
        @endif

        <div class="row">
            @foreach ($users as $u)
            <div class="col-md-4 mt-3">
                <div class="card bg-light border-warning">
                    <div class="card-body">
                        <p>{{ $u->name }} - {{ $u->role }}</p>
                        <a href="{{ route('users.edit', $u) }}">Editar</a>
                        <form action="{{ route('users.destroy', $u) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">
                                Borrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>