<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @include('components.header')

    <div class="container">
        <div class="row">
            <h1>Pedir cita en {{ $business->name }}</h1>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('businesses.appointments.store', $business) }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="employee_id">Empleado</label>
                    <select name="employee_id" id="employee_id"
                        class="form-control @error('employee_id') is-invalid @enderror">
                        <option value="">Selecciona un empleado</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" @if (old('employee_id') == $employee->id) selected @endif>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="service_id">Servicio</label>
                    <select name="service_id" id="service_id"
                        class="form-control @error('service_id') is-invalid @enderror">
                        <option value="">Selecciona un servicio</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" @if (old('service_id') == $service->id) selected @endif>
                                {{ $service->name }} - {{ $service->duration_minutes }} min - {{ $service->price }} €
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="appointment_date">Fecha</label>
                    <input type="date" class="form-control @error('appointment_date') is-invalid @enderror"
                        name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}">
                    @error('appointment_date')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="time">Hora</label>
                    <input type="time" class="form-control @error('time') is-invalid @enderror"
                        name="time" id="time" value="{{ old('time') }}" step="900">
                    @error('time')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label for="notes">Descripción</label>
                    <textarea name="notes" id="notes"
                        class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                    @error('notes')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Crear cita</button>

                <a href="{{ route('businesses.index') }}" class="btn btn-secondary mt-3">
                    Volver
                </a>
            </form>
        </div>
    </div>
</body>

</html>
