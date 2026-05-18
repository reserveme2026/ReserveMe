<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen flex flex-col transition-colors duration-200">
    @include('components.header')

    <main class="flex-1">
        <div class="max-w-5xl mx-auto px-4 py-10 flex flex-col gap-6">

            <div class="flex items-center justify-between gap-3 flex-wrap">
                <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                    Citas de {{ $business->name }}
                </h1>
                @if (auth()->user()->role == 'client')
                <a href="{{ route('businesses.appointments.create', $business) }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Pedir cita
                </a>
                @endif
            </div>

            @if (session('success'))
            <div class="flex items-center gap-2 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="flex items-center gap-2 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
            @endif

            @if ($appointments->count() > 0)

            {{-- TABLA: lg+ --}}
            <div class="hidden lg:block bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-violet-100 dark:border-gray-700">
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Cliente</th>
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
                            @php
                            $statusClasses = match($appointment->status) {
                            'confirmed' => 'bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800',
                            'cancelled' => 'bg-red-50 dark:bg-red-950 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800',
                            default => 'bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                            };
                            $statusLabel = match($appointment->status) {
                            'confirmed' => 'Confirmada',
                            'cancelled' => 'Cancelada',
                            default => 'Pendiente',
                            };
                            @endphp
                            <tr class="hover:bg-violet-50/50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->user?->name ?? 'Sin usuario' }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-violet-950 dark:text-gray-100">{{ $appointment->employee->name }}</td>
                                <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->service_name }}</td>
                                <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300 whitespace-nowrap">{{ $appointment->appointment_date }}</td>
                                <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->start_time }}</td>
                                <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $appointment->end_time }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-violet-600 dark:text-violet-400 max-w-[140px] truncate">{{ $appointment->notes }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        <a href="{{ route('businesses.appointments.show', [$business, $appointment]) }}"
                                            class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Ver</a>
                                        <a href="{{ route('businesses.appointments.edit', [$business, $appointment]) }}"
                                            class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Editar</a>
                                        @if ((auth()->user()->role == 'owner' || auth()->user()->role == 'employee') && $appointment->status == 'pending')
                                        <form action="{{ route('businesses.appointments.confirm', [$business, $appointment]) }}" method="post" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-2 py-1 text-xs font-semibold bg-emerald-50 dark:bg-emerald-950 hover:bg-emerald-100 dark:hover:bg-emerald-900 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 rounded-lg transition-colors duration-150">Aceptar</button>
                                        </form>
                                        <form action="{{ route('businesses.appointments.reject', [$business, $appointment]) }}" method="post" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-2 py-1 text-xs font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Rechazar</button>
                                        </form>
                                        @endif
                                        @if ((auth()->user()->role == 'client' && $appointment->status != 'cancelled') || (auth()->user()->role == 'employee' && $appointment->status == 'confirmed'))
                                        <form action="{{ route('businesses.appointments.cancel', [$business, $appointment]) }}" method="post" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-2 py-1 text-xs font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Cancelar</button>
                                        </form>
                                        @endif
                                        @if (auth()->user()->role == 'owner' && $business->owner_id == auth()->id())
                                        <form action="{{ route('businesses.appointments.destroy', [$business, $appointment]) }}" method="post" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-2 py-1 text-xs font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Eliminar</button>
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

            {{-- TARJETAS: móvil/tablet (< lg) --}}
            <div class="lg:hidden flex flex-col gap-4">
                @foreach ($appointments as $appointment)
                @php
                $statusClasses = match($appointment->status) {
                'confirmed' => 'bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800',
                'cancelled' => 'bg-red-50 dark:bg-red-950 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800',
                default => 'bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                };
                $statusLabel = match($appointment->status) {
                'confirmed' => 'Confirmada',
                'cancelled' => 'Cancelada',
                default => 'Pendiente',
                };
                @endphp
                <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                    <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                    <div class="p-4 flex flex-col gap-3">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Cliente</span>
                            <p class="text-violet-800 dark:text-gray-300">{{ $appointment->user?->name ?? 'Sin usuario' }}</p>
                        </div>

                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Empleado</span>
                                <p class="text-violet-800 dark:text-gray-300">{{ $appointment->employee?->name ?? 'Sin empleado' }}</p>
                            </div>

                            <div class="text-right">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Estado</span>
                                <div>
                                    <span class="inline-flex shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                        {{ $statusLabel }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-y-2 text-sm">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Servicio</span>
                                <p class="text-violet-800 dark:text-gray-300">{{ $appointment->service_name }}</p>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Fecha</span>
                                <p class="text-violet-800 dark:text-gray-300">{{ $appointment->appointment_date }}</p>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Inicio</span>
                                <p class="text-violet-800 dark:text-gray-300">{{ $appointment->start_time }}</p>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Fin</span>
                                <p class="text-violet-800 dark:text-gray-300">{{ $appointment->end_time }}</p>
                            </div>
                            @if ($appointment->notes)
                            <div class="col-span-2">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Notas</span>
                                <p class="text-violet-600 dark:text-violet-400">{{ $appointment->notes }}</p>
                            </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-1 border-t border-violet-50 dark:border-gray-700">
                            <a href="{{ route('businesses.appointments.show', [$business, $appointment]) }}"
                                class="text-center px-3 py-1.5 text-sm font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Ver</a>
                            <a href="{{ route('businesses.appointments.edit', [$business, $appointment]) }}"
                                class="text-center px-3 py-1.5 text-sm font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Editar</a>

                            @if ((auth()->user()->role == 'owner' || auth()->user()->role == 'employee') && $appointment->status == 'pending')
                            <form action="{{ route('businesses.appointments.confirm', [$business, $appointment]) }}" method="post">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full text-center px-3 py-1.5 text-sm font-semibold bg-emerald-50 dark:bg-emerald-950 hover:bg-emerald-100 dark:hover:bg-emerald-900 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 rounded-lg transition-colors duration-150">Aceptar</button>
                            </form>
                            <form action="{{ route('businesses.appointments.reject', [$business, $appointment]) }}" method="post">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full text-center px-3 py-1.5 text-sm font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Rechazar</button>
                            </form>
                            @endif

                            @if ((auth()->user()->role == 'client' && $appointment->status != 'cancelled') || (auth()->user()->role == 'employee' && $appointment->status == 'confirmed'))
                            <form action="{{ route('businesses.appointments.cancel', [$business, $appointment]) }}" method="post" class="col-span-2">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full text-center px-3 py-1.5 text-sm font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Cancelar</button>
                            </form>
                            @endif

                            @if (auth()->user()->role == 'owner' && $business->owner_id == auth()->id())
                            <form action="{{ route('businesses.appointments.destroy', [$business, $appointment]) }}" method="post" class="col-span-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full text-center px-3 py-1.5 text-sm font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Eliminar</button>
                            </form>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

            @else
            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm px-6 py-10 text-center">
                <p class="text-sm text-violet-400 dark:text-violet-500">No hay citas registradas para este negocio.</p>
            </div>
            @endif

            <div>
                <a href="{{ route('businesses.show', $business) }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver
                </a>
            </div>

        </div>
    </main>

    @include('components.footer')
</body>

</html>