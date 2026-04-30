<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle negocio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-8 flex flex-col gap-6">

        <h1 class="text-3xl font-bold text-gray-800">{{ $business->name }}</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3">
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Dirección:</span> {{ $business->address }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Teléfono:</span> {{ $business->phone }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Email:</span> {{ $business->email }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Descripción:</span> {{ $business->description }}</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('businesses.index') }}"
                class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                Volver
            </a>
            <a href="{{ route('businesses.appointments.create', $business) }}"
                class="px-4 py-2 text-sm bg-green-500 hover:bg-green-600 text-white rounded-lg transition">
                Pedir cita
            </a>
        </div>

        @auth
            @if ((auth()->user()->role == 'owner' && $business->owner_id == auth()->id()) || auth()->user()->role == 'admin')
                <div class="flex flex-col gap-4">
                    <hr class="border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Panel de administración</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('businesses.edit', $business) }}"
                            class="px-4 py-2 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg transition">
                            Editar negocio
                        </a>
                        <a href="{{ route('businesses.employees.index', $business) }}"
                            class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                            Empleados
                        </a>
                        <a href="{{ route('businesses.services.index', $business) }}"
                            class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                            Servicios
                        </a>
                        <a href="{{ route('businesses.appointments.index', $business) }}"
                            class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                            Citas
                        </a>
                    </div>
                </div>
            @endif
        @endauth

    </div>
</body>

</html>