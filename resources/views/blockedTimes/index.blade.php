<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloqueos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-4xl mx-auto px-4 py-8 flex flex-col gap-4">

        <h1 class="text-3xl font-bold text-gray-800">Bloqueos de {{ $employee->name }}</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <a href="{{ route('employees.blockedTimes.create', $employee) }}"
                class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition">
                Crear bloqueo
            </a>
        </div>

        @if ($blockedTimes->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Hora inicio</th>
                            <th class="px-4 py-3">Hora fin</th>
                            <th class="px-4 py-3">Motivo</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($blockedTimes as $blockedTime)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-gray-700">{{ $blockedTime->block_date }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $blockedTime->start_time }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $blockedTime->end_time }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $blockedTime->reason }}</td>
                                <td class="px-4 py-3 flex flex-wrap gap-2">
                                    <a href="{{ route('employees.blockedTimes.show', [$employee, $blockedTime]) }}"
                                        class="px-3 py-1.5 text-xs bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition">
                                        Ver
                                    </a>
                                    <a href="{{ route('employees.blockedTimes.edit', [$employee, $blockedTime]) }}"
                                        class="px-3 py-1.5 text-xs bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg transition">
                                        Editar
                                    </a>
                                    <form action="{{ route('employees.blockedTimes.destroy', [$employee, $blockedTime]) }}"
                                        method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 text-xs bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Este empleado no tiene bloqueos creados.</p>
        @endif

        <div>
            <a href="{{ route('businesses.employees.index', $employee->business_id) }}"
                class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                Volver
            </a>
        </div>

    </div>
</body>

</html>