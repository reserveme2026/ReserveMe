<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen flex flex-col transition-colors duration-200">
    @include('components.header')

    <main class="flex-1">
        <div class="max-w-4xl mx-auto px-4 py-4">

            <div class="flex items-center gap-3 mb-6 flex-wrap">
                @auth
                @if (auth()->user()->role == 'owner' || auth()->user()->role == 'employee')
                <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                    Mis <span class="text-violet-600 dark:text-violet-400">negocios</span>
                </h1>
                @else
                <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                    <span class="text-violet-600 dark:text-violet-400">Negocios</span> disponibles
                </h1>
                @endif
                @else
                <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                    <span class="text-violet-600 dark:text-violet-400">Negocios</span> disponibles
                </h1>
                @endauth

                <span class="bg-violet-200 dark:bg-violet-900 text-violet-800 dark:text-violet-300 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $businesses->count() }}
                </span>

                @auth
                @if (auth()->user()->role == 'owner' && auth()->user()->owner_plan)
                <span class="bg-white dark:bg-gray-800 border border-violet-200 dark:border-gray-600 text-violet-700 dark:text-violet-300 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    Plan {{ ucfirst(auth()->user()->owner_plan) }}
                </span>
                @endif
                @endauth
            </div>

            @if (session('success'))
            <div class="flex items-center gap-2 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 text-sm px-4 py-3 rounded-xl mb-5 shadow-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="flex items-center gap-2 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm px-4 py-3 rounded-xl mb-5 shadow-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('businesses.index') }}" method="GET" class="mb-5">
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Buscar por nombre, direccion o descripcion"
                        class="flex-1 bg-white dark:bg-gray-700 border border-violet-200 dark:border-gray-600 rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent dark:focus:bg-gray-600 transition">

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 text-sm font-semibold rounded-xl bg-violet-600 hover:bg-violet-700 dark:bg-violet-700 dark:hover:bg-violet-600 text-white transition-colors duration-150 shadow-sm cursor-pointer">
                        Buscar
                    </button>

                    @if (request('search'))
                    <a href="{{ route('businesses.index') }}"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 text-sm font-semibold rounded-xl border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        Limpiar
                    </a>
                    @endif
                </div>
            </form>

            @if (request('search'))
            <p class="text-sm text-violet-500 dark:text-violet-400 mb-5">
                Resultados para
                <span class="font-semibold text-violet-700 dark:text-violet-300">{{ request('search') }}</span>
            </p>
            @endif

            @if ($businesses->count() > 0)
            <div class="flex flex-col gap-4">
                @foreach ($businesses as $business)
                <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm hover:shadow-lg hover:border-violet-300 dark:hover:border-violet-700 hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">
                    <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

                    @if ($business->image)
                    <img src="{{ asset('storage/' . $business->image) }}"
                        alt="{{ $business->name }}"
                        class="w-full h-48 object-cover">
                    @else
                    <img src="{{ asset('images/default.png') }}"
                        alt="Imagen por defecto"
                        class="w-full h-48 object-cover">
                    @endif

                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h2 class="text-lg font-bold text-violet-950 dark:text-gray-100">
                                {{ $business->name }}
                            </h2>

                            <span class="inline-flex items-center gap-1 bg-violet-50 dark:bg-violet-900 text-violet-700 dark:text-violet-300 text-xs font-semibold px-2.5 py-1 rounded-full border border-violet-200 dark:border-violet-700 shrink-0 ml-3">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 011.414-1.414L8.414 12.172l6.879-6.879a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Verificado
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 bg-violet-50/70 dark:bg-gray-700/50 border border-violet-100 dark:border-gray-600 rounded-xl px-4 py-3.5 mb-5">
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400 dark:text-violet-500">Dirección</span>
                                <span class="text-sm font-medium text-violet-950 dark:text-gray-100">{{ $business->address }}</span>
                            </div>

                            <div class="flex flex-col gap-0.5">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400 dark:text-violet-500">Teléfono</span>
                                <span class="text-sm font-medium text-violet-950 dark:text-gray-100">{{ $business->phone }}</span>
                            </div>

                            <div class="flex flex-col gap-0.5">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400 dark:text-violet-500">Email</span>
                                <span class="text-sm font-medium text-violet-950 dark:text-gray-100">{{ $business->email }}</span>
                            </div>

                            <div class="flex flex-col gap-0.5 sm:col-span-2">
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-400 dark:text-violet-500">Descripción</span>
                                <span class="text-sm text-violet-800 dark:text-gray-300">{{ $business->description }}</span>
                            </div>
                        </div>

                        <div class="border-t border-violet-50 dark:border-gray-700 mb-4"></div>

                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('businesses.show', $business) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-1.5 text-sm font-semibold rounded-lg bg-violet-600 hover:bg-violet-700 dark:bg-violet-700 dark:hover:bg-violet-600 text-white transition-colors duration-150 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Ver
                            </a>

                            @auth
                            @if (auth()->user()->role == 'client')
                            <a href="{{ route('businesses.appointments.create', $business) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-1.5 text-sm font-semibold rounded-lg
                                       bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Pedir cita
                            </a>
                            @endif
                            @endauth

                            @auth
                            @if (auth()->user()->role == 'owner' && $business->owner_id == auth()->id())
                            <div class="w-px h-5 bg-violet-100 dark:bg-gray-600 mx-1 self-center"></div>

                            <a href="{{ route('businesses.edit', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                Editar
                            </a>

                            <a href="{{ route('businesses.employees.index', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 transition-colors duration-150">
                                Empleados
                            </a>

                            <a href="{{ route('businesses.services.index', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 transition-colors duration-150">
                                Servicios
                            </a>
                            @endif

                            @if ((auth()->user()->role == 'owner' && $business->owner_id == auth()->id()) || auth()->user()->role == 'employee')
                            <a href="{{ route('businesses.appointments.index', $business) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 transition-colors duration-150">
                                Citas
                            </a>
                            @endif

                            @if ((auth()->user()->role == 'owner' && $business->owner_id == auth()->id()) || auth()->user()->role == 'admin')
                            <form action="{{ route('businesses.destroy', $business) }}" method="post" class="inline ml-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-semibold rounded-lg
                                           bg-red-500 hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-600 text-white transition-colors duration-150 shadow-sm cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm py-16 px-6 text-center">
                <div class="text-violet-200 dark:text-violet-800 mb-3">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                @if (request('search'))
                <p class="text-violet-400 dark:text-violet-500 text-sm font-medium">No se han encontrado negocios para esa busqueda.</p>
                @else
                <p class="text-violet-400 dark:text-violet-500 text-sm font-medium">No hay negocios disponibles.</p>
                @endif
            </div>
            @endif

        </div>
    </main>

    @include('components.footer')
</body>

</html>