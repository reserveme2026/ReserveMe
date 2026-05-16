<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis citas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-5xl mx-auto px-4 py-10 flex flex-col gap-6">

        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                Mis citas
            </h1>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-2 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center gap-2 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if ($appointments->count() > 0)
            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-violet-100 dark:border-gray-700">
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Negocio</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Empleado</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Servicio</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Fecha</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Inicio</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Fin</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Estado</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Notas</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-violet-50 dark:divide-gray-700">
                            @foreach ($appointments as $appointment)
                                <tr class="hover:bg-violet-50/50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-4 py-3 text-sm font-medium text-violet-950 dark:text-gray-100">{{ $appointment->business->name }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->employee->name }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->service_name }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->appointment_date }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->start_time }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->end_time }}</td>
                                    <td class="px-4 py-3">
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
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-violet-600 dark:text-violet-400 max-w-[140px] truncate">{{ $appointment->notes }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-1">

                                            <a href="{{ route('businesses.appointments.show', [$appointment->business, $appointment]) }}"
                                                class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">
                                                Ver
                                            </a>

                                            <a href="{{ route('businesses.appointments.edit', [$appointment->business, $appointment]) }}"
                                                class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">
                                                Editar
                                            </a>

                                            @if ($appointment->status != 'cancelled')
                                                <form action="{{ route('businesses.appointments.cancel', [$appointment->business, $appointment]) }}"
                                                    method="post" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">
                                                        Cancelar
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm px-6 py-10 text-center">
                <p class="text-sm text-violet-400 dark:text-violet-500">No tienes citas registradas.</p>
            </div>
        @endif

        <div>
            <a href="{{ route('businesses.index') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

    </div>
</body>

</html>