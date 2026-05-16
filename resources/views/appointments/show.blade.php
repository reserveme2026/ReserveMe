<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle cita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-lg mx-auto px-4 py-10 flex flex-col gap-6">

        <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">Detalle de la cita</h1>

        <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
            <div class="p-6 flex flex-col gap-3">

                @php
                    $statusClasses = match($appointment->status) {
                        'confirmed' => 'bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800',
                        'cancelled' => 'bg-red-50 dark:bg-red-950 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800',
                        default     => 'bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                    };
                    $statusLabel = match($appointment->status) {
                        'confirmed' => 'Confirmada',
                        'cancelled' => 'Cancelada',
                        default     => 'Pendiente',
                    };
                @endphp

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Negocio</span>
                    <span class="text-violet-950 dark:text-gray-100">{{ $business->name }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Empleado</span>
                    <span class="text-violet-800 dark:text-gray-300">{{ $appointment->employee->name }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Servicio</span>
                    <span class="text-violet-800 dark:text-gray-300">{{ $appointment->service_name }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Fecha</span>
                    <span class="text-violet-800 dark:text-gray-300">{{ $appointment->appointment_date }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Hora inicio</span>
                    <span class="text-violet-800 dark:text-gray-300">{{ $appointment->start_time }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Hora fin</span>
                    <span class="text-violet-800 dark:text-gray-300">{{ $appointment->end_time }}</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Estado</span>
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClasses }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Duración</span>
                    <span class="text-violet-800 dark:text-gray-300">{{ $appointment->service_duration_minutes }} min</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Precio</span>
                    <span class="text-violet-800 dark:text-gray-300">{{ $appointment->service_price }} €</span>
                </div>

                <div class="flex items-center gap-2 text-sm">
                    <span class="font-medium text-violet-400 dark:text-violet-500 w-36">Notas</span>
                    <span class="text-violet-600 dark:text-violet-400">{{ $appointment->notes }}</span>
                </div>

                <div class="flex gap-2 mt-4 pt-4 border-t border-violet-100 dark:border-gray-700">
                    <a href="{{ route('businesses.appointments.edit', [$business, $appointment]) }}"
                        class="px-4 py-2 text-sm font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">
                        Editar
                    </a>
                    <a href="{{ route('businesses.appointments.index', $business) }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
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