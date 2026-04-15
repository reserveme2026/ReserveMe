<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>empleados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include("components.header")

    <div class="container mt-4">
        <h2>Empleados</h2>

        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }}
            </div>
        @endif

        <div class="row">
            @foreach ($employees as $employee)
                <div class="col-md-4 mt-3">
                    <div class="card bg-light border-warning">
                        <div class="card-body">
                            <p>{{ $employee->name }}</p>
                            <p>{{ $employee->email }}</p>
                            <a href="{{ route('employees.edit', $employee->id) }}"><button type="button"
                                    class="btn btn-primary ">Editar</button></a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
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