<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle bloqueo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        <h1 class="text-2xl font-bold text-violet-950">Detalle del bloqueo de {{ $employee->name }}</h1>

        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
            <div class="p-6 flex flex-col gap-3">

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 w-36">Fecha</span>
                    <span class="text-violet-950">{{ $blockedTime->block_date }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 w-36">Hora inicio</span>
                    <span class="text-violet-800">{{ $blockedTime->start_time }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 w-36">Hora fin</span>
                    <span class="text-violet-800">{{ $blockedTime->end_time }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 w-36">Motivo</span>
                    <span class="text-violet-600">{{ $blockedTime->reason }}</span>
                </div>

                <div class="flex gap-2 mt-4 pt-4 border-t border-violet-100">
                    <a href="{{ route('employees.blockedTimes.edit', [$employee, $blockedTime]) }}"
                        class="px-4 py-2 text-sm font-semibold bg-violet-100 hover:bg-violet-200 text-violet-700 rounded-lg transition-colors duration-150">
                        Editar
                    </a>
                    <a href="{{ route('employees.blockedTimes.index', $employee) }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                               border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>
                </div>

            </div>
        </div>

    </div>
</body>

</html>