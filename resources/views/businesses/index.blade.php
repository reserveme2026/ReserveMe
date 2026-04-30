<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="flex flex-col gap-4">

            @auth
                @if (auth()->user()->role == 'owner')
                    <h1 class="text-3xl font-bold text-gray-800">Mis negocios</h1>
                @else
                    <h1 class="text-3xl font-bold text-gray-800">Negocios</h1>
                @endif
            @else
                <h1 class="text-3xl font-bold text-gray-800">Negocios</h1>
            @endauth

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($businesses->count() > 0)
                @foreach ($businesses as $business)
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3">

                        <h5 class="text-xl font-semibold text-gray-900">{{ $business->name }}</h5>

                        <p class="text-gray-600 text-sm">
                            <span class="font-semibold text-gray-700">Dirección:</span> {{ $business->address }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            <span class="font-semibold text-gray-700">Teléfono:</span> {{ $business->phone }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            <span class="font-semibold text-gray-700">Email:</span> {{ $business->email }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            <span class="font-semibold text-gray-700">Descripción:</span> {{ $business->description }}
                        </p>

                        <div class="flex flex-wrap gap-2 mt-2">
                            <a href="{{ route('businesses.show', $business) }}"
                                class="px-3 py-1.5 text-sm bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition">
                                Ver
                            </a>

                            <a href="{{ route('businesses.appointments.create', $business) }}"
                                class="px-3 py-1.5 text-sm bg-green-500 hover:bg-green-600 text-white rounded-lg transition">
                                Pedir cita
                            </a>

                            @auth
                                @if ((auth()->user()->role == 'owner' && $business->owner_id == auth()->id()) || auth()->user()->role == 'admin')
                                    <a href="{{ route('businesses.edit', $business) }}"
                                        class="px-3 py-1.5 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg transition">
                                        Editar
                                    </a>

                                    <form action="{{ route('businesses.destroy', $business) }}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                                            Eliminar
                                        </button>
                                    </form>

                                    <a href="{{ route('businesses.employees.index', $business) }}"
                                        class="px-3 py-1.5 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                                        Empleados
                                    </a>

                                    <a href="{{ route('businesses.services.index', $business) }}"
                                        class="px-3 py-1.5 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                                        Servicios
                                    </a>

                                    <a href="{{ route('businesses.appointments.index', $business) }}"
                                        class="px-3 py-1.5 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                                        Citas
                                    </a>
                                @endif
                            @endauth
                        </div>

                    </div>
                @endforeach
            @else
                <p class="text-gray-500 text-center py-8">No hay negocios disponibles.</p>
            @endif

        </div>
    </div>

</body>

</html>