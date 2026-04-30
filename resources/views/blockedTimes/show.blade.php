<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle bloqueo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-8 flex flex-col gap-6">

        <h1 class="text-3xl font-bold text-gray-800">Detalle del bloqueo de {{ $employee->name }}</h1>

        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3">
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Fecha:</span>
                {{ $blockedTime->block_date }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Hora inicio:</span>
                {{ $blockedTime->start_time }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Hora fin:</span>
                {{ $blockedTime->end_time }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold text-gray-700">Motivo:</span>
                {{ $blockedTime->reason }}</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('employees.blockedTimes.edit', [$employee, $blockedTime]) }}"
                class="px-4 py-2 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg transition">
                Editar
            </a>
            <a href="{{ route('employees.blockedTimes.index', $employee) }}"
                class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                Volver
            </a>
        </div>

    </div>
</body>

</html>