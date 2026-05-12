<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle negocio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        {{-- Page header --}}
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-violet-950">
                {{ $business->name }}
            </h1>
            <span class="inline-flex items-center gap-1 bg-violet-50 text-violet-700 text-xs font-semibold px-2.5 py-1 rounded-full border border-violet-200 shrink-0">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 011.414-1.414L8.414 12.172l6.879-6.879a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Verificado
            </span>
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

        {{-- Info card --}}
        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 bg-violet-50/70 border border-violet-100 rounded-xl px-4 py-3.5 m-6">
                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Dirección</span>
                    <span class="text-sm font-medium text-violet-950">{{ $business->address }}</span>
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Teléfono</span>
                    <span class="text-sm font-medium text-violet-950">{{ $business->phone }}</span>
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Email</span>
                    <span class="text-sm font-medium text-violet-950">{{ $business->email }}</span>
                </div>
                <div class="flex flex-col gap-0.5 sm:col-span-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Descripción</span>
                    <span class="text-sm text-violet-800">{{ $business->description }}</span>
                </div>
            </div>
        </div>

        {{-- Public actions --}}
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('businesses.index') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                       border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
            <a href="{{ route('businesses.appointments.create', $business) }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                       bg-purple-500 hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Pedir cita
            </a>
        </div>

        {{-- Admin panel --}}
        @auth
            @if ((auth()->user()->role == 'owner' && $business->owner_id == auth()->id()) || auth()->user()->role == 'admin')
                <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
                    <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                    <div class="p-6 flex flex-col gap-4">

                        <h3 class="text-[10px] font-bold uppercase tracking-widest text-violet-400">
                            Panel de administración
                        </h3>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('businesses.edit', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg
                                       border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar negocio
                            </a>
                            <a href="{{ route('businesses.employees.index', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg
                                       bg-violet-100 hover:bg-violet-200 text-violet-700 transition-colors duration-150">
                                Empleados
                            </a>
                            <a href="{{ route('businesses.services.index', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg
                                       bg-violet-100 hover:bg-violet-200 text-violet-700 transition-colors duration-150">
                                Servicios
                            </a>
                            <a href="{{ route('businesses.appointments.index', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg
                                       bg-violet-100 hover:bg-violet-200 text-violet-700 transition-colors duration-150">
                                Citas
                            </a>
                        </div>

                    </div>
                </div>
            @endif
        @endauth

    </div>
</body>

</html>