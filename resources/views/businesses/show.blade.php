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

        <div class="flex items-center gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-violet-950">
                {{ $business->name }}
            </h1>

            <span class="inline-flex items-center gap-1 bg-violet-50 text-violet-700 text-xs font-semibold px-2.5 py-1 rounded-full border border-violet-200 shrink-0">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 011.414-1.414L8.414 12.172l6.879-6.879a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Verificado
            </span>
        </div>

        @if (session('success'))
        <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

            <div>
                @if ($business->image)
                <img src="{{ asset('storage/' . $business->image) }}"
                    alt="{{ $business->name }}"
                    class="w-full h-72 object-cover">
                @else
                <img src="{{ asset('images/default.png') }}"
                    alt="Imagen por defecto"
                    class="w-full h-72 object-cover">
                @endif

                <div class="px-6 pt-6 pb-6">
                    <div class="max-w-4xl mx-auto bg-violet-50/70 border border-violet-100 rounded-xl px-5 py-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400">Direccion</span>
                                <span class="text-sm font-medium text-violet-950">{{ $business->address }}</span>
                            </div>

                            <div class="flex flex-col gap-0.5">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400">Telefono</span>
                                <span class="text-sm font-medium text-violet-950">{{ $business->phone }}</span>
                            </div>

                            <div class="flex flex-col gap-0.5 sm:col-span-2">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400">Email</span>
                                <span class="text-sm font-medium text-violet-950">{{ $business->email }}</span>
                            </div>
                        </div>

                        <div class="border-t border-violet-100 mt-5 pt-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400">Descripcion</span>
                                <p class="text-sm text-violet-800 leading-relaxed">{{ $business->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-6 pb-6">
                    <div class="max-w-4xl mx-auto border-t border-violet-100 pt-5 flex flex-wrap items-center gap-2">
                        <a href="{{ route('businesses.index') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver
                        </a>

                        <a href="{{ route('businesses.appointments.create', $business) }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg bg-purple-500 hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Pedir cita
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>