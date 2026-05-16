<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes owner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    @php
        $isOwner = auth()->user()->role == 'owner';
        $currentPlan = auth()->user()->owner_plan;
    @endphp

    <div class="max-w-6xl mx-auto px-4 py-10 flex flex-col gap-8">

        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-violet-950 dark:text-violet-200">
                {{ $isOwner ? 'Actualiza tu plan owner' : 'Elige tu plan owner' }}
            </h1>
            <p class="text-sm text-violet-700 dark:text-violet-400 max-w-2xl">
                {{ $isOwner
                    ? 'Puedes solicitar un cambio de plan. La solicitud será revisada por un administrador antes de aplicarse.'
                    : 'Selecciona el plan que mejor se adapte a tu negocio. Tu solicitud será revisada por un administrador antes de activarse.' }}
            </p>
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

        @if ($pendingRequest)
            <div class="flex items-center gap-2 bg-amber-50 dark:bg-amber-950 border border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-400 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Ya tienes una solicitud pendiente para el plan
                <span class="font-semibold">{{ ucfirst($pendingRequest->requested_plan) }}</span>.
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Starter --}}
            <div class="bg-white dark:bg-gray-800 border border-emerald-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-emerald-500"></div>
                <div class="p-6 flex flex-col gap-5 h-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-slate-950 dark:text-gray-100">Starter</h2>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950 px-2 py-1 rounded-full">
                                Básico
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-gray-400">
                            Ideal para empezar con una gestión sencilla.
                        </p>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-3xl font-bold text-slate-950 dark:text-gray-100">1 negocio</span>
                        <span class="text-sm text-slate-500 dark:text-gray-500">Límite de creación incluido en el plan</span>
                    </div>

                    <ul class="flex flex-col gap-2 text-sm text-slate-700 dark:text-gray-300">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Gestión de citas
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Gestión de servicios
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Gestión de empleados
                        </li>
                    </ul>

                    <div class="mt-auto pt-2">
                        @if ($pendingRequest)
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-slate-200 dark:border-gray-600 bg-slate-100 dark:bg-gray-700 text-slate-400 dark:text-gray-500 cursor-not-allowed">
                                Solicitud pendiente
                            </button>
                        @elseif ($isOwner && $currentPlan == 'starter')
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-emerald-200 dark:border-emerald-800 bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 cursor-default">
                                Plan actual
                            </button>
                        @else
                            <form action="{{ route('ownerRequests.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="requested_plan" value="starter">
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white transition-colors duration-150 shadow-sm">
                                    {{ $isOwner ? 'Solicitar cambio a Starter' : 'Solicitar plan Starter' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Pro --}}
            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-violet-500"></div>
                <div class="p-6 flex flex-col gap-5 h-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-slate-950 dark:text-gray-100">Pro</h2>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-violet-600 dark:text-violet-400 bg-violet-50 dark:bg-violet-950 px-2 py-1 rounded-full">
                                Recomendado
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-gray-400">
                            Pensado para quienes quieren crecer con más margen.
                        </p>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-3xl font-bold text-slate-950 dark:text-gray-100">3 negocios</span>
                        <span class="text-sm text-slate-500 dark:text-gray-500">Más capacidad para ampliar tu actividad</span>
                    </div>

                    <ul class="flex flex-col gap-2 text-sm text-slate-700 dark:text-gray-300">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-violet-500"></span>
                            Gestión de citas
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-violet-500"></span>
                            Gestión de servicios
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-violet-500"></span>
                            Gestión de empleados
                        </li>
                    </ul>

                    <div class="mt-auto pt-2">
                        @if ($pendingRequest)
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-slate-200 dark:border-gray-600 bg-slate-100 dark:bg-gray-700 text-slate-400 dark:text-gray-500 cursor-not-allowed">
                                Solicitud pendiente
                            </button>
                        @elseif ($isOwner && $currentPlan == 'pro')
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-violet-200 dark:border-violet-800 bg-violet-50 dark:bg-violet-950 text-violet-700 dark:text-violet-400 cursor-default">
                                Plan actual
                            </button>
                        @else
                            <form action="{{ route('ownerRequests.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="requested_plan" value="pro">
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg bg-violet-500 hover:bg-violet-600 text-white transition-colors duration-150 shadow-sm">
                                    {{ $isOwner ? 'Solicitar cambio a Pro' : 'Solicitar plan Pro' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Premium --}}
            <div class="bg-white dark:bg-gray-800 border border-amber-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-amber-500"></div>
                <div class="p-6 flex flex-col gap-5 h-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-slate-950 dark:text-gray-100">Premium</h2>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950 px-2 py-1 rounded-full">
                                Avanzado
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-gray-400">
                            Para usuarios que necesitan una gestión más amplia.
                        </p>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-3xl font-bold text-slate-950 dark:text-gray-100">6 negocios</span>
                        <span class="text-sm text-slate-500 dark:text-gray-500">La opción con mayor capacidad de creación</span>
                    </div>

                    <ul class="flex flex-col gap-2 text-sm text-slate-700 dark:text-gray-300">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Gestión de citas
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Gestión de servicios
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Gestión de empleados
                        </li>
                    </ul>

                    <div class="mt-auto pt-2">
                        @if ($pendingRequest)
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-slate-200 dark:border-gray-600 bg-slate-100 dark:bg-gray-700 text-slate-400 dark:text-gray-500 cursor-not-allowed">
                                Solicitud pendiente
                            </button>
                        @elseif ($isOwner && $currentPlan == 'premium')
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-amber-200 dark:border-amber-800 bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-400 cursor-default">
                                Plan actual
                            </button>
                        @else
                            <form action="{{ route('ownerRequests.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="requested_plan" value="premium">
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg bg-amber-500 hover:bg-amber-600 text-white transition-colors duration-150 shadow-sm">
                                    {{ $isOwner ? 'Solicitar cambio a Premium' : 'Solicitar plan Premium' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="flex items-center gap-2">
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