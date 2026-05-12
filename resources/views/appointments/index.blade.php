<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-5xl mx-auto px-4 py-10 flex flex-col gap-6">

        {{-- Page header --}}
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-violet-950">
                Citas de {{ $business->name }}
            </h1>
            @if (auth()->user()->role == 'client')
                <a href="{{ route('businesses.appointments.create', $business) }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                           bg-purple-500 hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Pedir cita
                </a>
            @endif
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Table card --}}
        @if ($appointments->count() > 0)
            <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-violet-100">
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Empleado</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Servicio</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Fecha</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Inicio</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Fin</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Estado</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Notas</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-violet-50">
                            @foreach ($appointments as $appointment)
                                <tr class="hover:bg-violet-50/50 transition-colors duration-150">
                                    <td class="px-4 py-3 text-sm font-medium text-violet-950">{{ $appointment->employee->name }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800">{{ $appointment->service_name }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800">{{ $appointment->appointment_date }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800">{{ $appointment->start_time }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800">{{ $appointment->end_time }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusClasses = match($appointment->status) {
                                                'confirmed' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                                'cancelled' => 'bg-red-50 text-red-700 border border-red-200',
                                                default     => 'bg-amber-50 text-amber-700 border border-amber-200',
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
                                    <td class="px-4 py-3 text-sm text-violet-600 max-w-[140px] truncate">{{ $appointment->notes }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-1">

                                            <a href="{{ route('businesses.appointments.show', [$business, $appointment]) }}"
                                                class="px-2 py-1 text-xs font-semibold bg-violet-100 hover:bg-violet-200 text-violet-700 rounded-lg transition-colors duration-150">
                                                Ver
                                            </a>

                                            <a href="{{ route('businesses.appointments.edit', [$business, $appointment]) }}"
                                                class="px-2 py-1 text-xs font-semibold bg-violet-100 hover:bg-violet-200 text-violet-700 rounded-lg transition-colors duration-150">
                                                Editar
                                            </a>

                                            @if ((auth()->user()->role == 'owner' || auth()->user()->role == 'admin') && $appointment->status == 'pending')
                                                <form action="{{ route('businesses.appointments.confirm', [$business, $appointment]) }}"
                                                    method="post" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs font-semibold bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-lg transition-colors duration-150">
                                                        Aceptar
                                                    </button>
                                                </form>

                                                <form action="{{ route('businesses.appointments.reject', [$business, $appointment]) }}"
                                                    method="post" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs font-semibold bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 rounded-lg transition-colors duration-150">
                                                        Rechazar
                                                    </button>
                                                </form>
                                            @endif

                                            @if (auth()->user()->role == 'client' && $appointment->status != 'cancelled')
                                                <form action="{{ route('businesses.appointments.cancel', [$business, $appointment]) }}"
                                                    method="post" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs font-semibold bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 rounded-lg transition-colors duration-150">
                                                        Cancelar
                                                    </button>
                                                </form>
                                            @endif

                                            @if (auth()->user()->role == 'admin' || (auth()->user()->role == 'owner' && $business->owner_id == auth()->id()))
                                                <form action="{{ route('businesses.appointments.destroy', [$business, $appointment]) }}"
                                                    method="post" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs font-semibold bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 rounded-lg transition-colors duration-150">
                                                        Eliminar
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
            <div class="bg-white border border-violet-100 rounded-2xl shadow-sm px-6 py-10 text-center">
                <p class="text-sm text-violet-400">No hay citas registradas para este negocio.</p>
            </div>
        @endif

        {{-- Back --}}
        <div>
            <a href="{{ route('businesses.show', $business) }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                       border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

    </div>
</body>

</html>