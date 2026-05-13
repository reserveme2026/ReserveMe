<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes owner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    @php
        $isOwner = auth()->user()->role == 'owner';
        $currentPlan = auth()->user()->owner_plan;
    @endphp

    <div class="max-w-6xl mx-auto px-4 py-10 flex flex-col gap-8">

        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-violet-950">
                {{ $isOwner ? 'Actualiza tu plan owner' : 'Elige tu plan owner' }}
            </h1>

            <p class="text-sm text-violet-700 max-w-2xl">
                {{ $isOwner
                    ? 'Puedes solicitar un cambio de plan. La solicitud será revisada por un administrador antes de aplicarse.'
                    : 'Selecciona el plan que mejor se adapte a tu negocio. Tu solicitud será revisada por un administrador antes de activarse.' }}
            </p>
        </div>

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

        @if ($pendingRequest)
            <div class="flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-700 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Ya tienes una solicitud pendiente para el plan
                <span class="font-semibold">{{ ucfirst($pendingRequest->requested_plan) }}</span>.
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-white border border-emerald-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-emerald-500"></div>
                <div class="p-6 flex flex-col gap-5 h-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-slate-950">Starter</h2>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                                Básico
                            </span>
                        </div>
                        <p class="text-sm text-slate-600">
                            Ideal para empezar con una gestión sencilla.
                        </p>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-3xl font-bold text-slate-950">1 negocio</span>
                        <span class="text-sm text-slate-500">Límite de creación incluido en el plan</span>
                    </div>

                    <ul class="flex flex-col gap-2 text-sm text-slate-700">
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
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed">
                                Solicitud pendiente
                            </button>
                        @elseif ($isOwner && $currentPlan == 'starter')
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-700 cursor-default">
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

            <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-violet-500"></div>
                <div class="p-6 flex flex-col gap-5 h-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-slate-950">Pro</h2>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-violet-600 bg-violet-50 px-2 py-1 rounded-full">
                                Recomendado
                            </span>
                        </div>
                        <p class="text-sm text-slate-600">
                            Pensado para quienes quieren crecer con más margen.
                        </p>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-3xl font-bold text-slate-950">3 negocios</span>
                        <span class="text-sm text-slate-500">Más capacidad para ampliar tu actividad</span>
                    </div>

                    <ul class="flex flex-col gap-2 text-sm text-slate-700">
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
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed">
                                Solicitud pendiente
                            </button>
                        @elseif ($isOwner && $currentPlan == 'pro')
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-violet-200 bg-violet-50 text-violet-700 cursor-default">
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

            <div class="bg-white border border-amber-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-amber-500"></div>
                <div class="p-6 flex flex-col gap-5 h-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-slate-950">Premium</h2>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-amber-700 bg-amber-50 px-2 py-1 rounded-full">
                                Avanzado
                            </span>
                        </div>
                        <p class="text-sm text-slate-600">
                            Para usuarios que necesitan una gestión más amplia.
                        </p>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-3xl font-bold text-slate-950">6 negocios</span>
                        <span class="text-sm text-slate-500">La opción con mayor capacidad de creación</span>
                    </div>

                    <ul class="flex flex-col gap-2 text-sm text-slate-700">
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
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed">
                                Solicitud pendiente
                            </button>
                        @elseif ($isOwner && $currentPlan == 'premium')
                            <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-lg border border-amber-200 bg-amber-50 text-amber-700 cursor-default">
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
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

    </div>
</body>

</html>
