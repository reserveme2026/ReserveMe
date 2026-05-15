<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle usuario</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        {{-- Page header --}}
        <h1 class="text-2xl font-bold text-violet-950">Detalle usuario</h1>

        {{-- Info card --}}
        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

            @php
                $requestClasses = match($user->owner_request_status) {
                    'approved' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                    'rejected' => 'bg-red-50 text-red-700 border border-red-200',
                    'pending'  => 'bg-amber-50 text-amber-700 border border-amber-200',
                    default    => 'bg-violet-50 text-violet-400 border border-violet-200',
                };
                $requestLabel = match($user->owner_request_status) {
                    'approved' => 'Aprobada',
                    'rejected' => 'Rechazada',
                    'pending'  => 'Pendiente',
                    default    => '—',
                };
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 bg-violet-50/70 border border-violet-100 rounded-xl px-4 py-3.5 m-6">
                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Nombre</span>
                    <span class="text-sm font-medium text-violet-950">{{ $user->name }}</span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Email</span>
                    <span class="text-sm font-medium text-violet-950">{{ $user->email }}</span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Rol</span>
                    <span class="inline-flex w-fit mt-0.5 px-2 py-0.5 rounded-full text-xs font-semibold bg-violet-100 text-violet-700 border border-violet-200">
                        {{ $user->role }}
                    </span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Solicitud owner</span>
                    @if ($user->owner_request_status)
                        <span class="inline-flex w-fit mt-0.5 px-2 py-0.5 rounded-full text-xs font-semibold {{ $requestClasses }}">
                            {{ $requestLabel }}
                        </span>
                    @else
                        <span class="text-sm text-violet-300">—</span>
                    @endif
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-wrap gap-2 px-6 pb-6">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                           border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
                <a href="{{ route('users.edit', $user) }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                           bg-purple-500 hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Editar
                </a>
            </div>
        </div>

    </div>
</body>

</html>