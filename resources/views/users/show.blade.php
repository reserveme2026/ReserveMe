<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle usuario</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">Detalle usuario</h1>

        <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

            @php
                $requestClasses = match($user->owner_request_status) {
                    'approved' => 'bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800',
                    'rejected' => 'bg-red-50 dark:bg-red-950 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800',
                    'pending'  => 'bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                    default    => 'bg-violet-50 dark:bg-violet-950 text-violet-400 dark:text-violet-500 border border-violet-200 dark:border-violet-800',
                };
                $requestLabel = match($user->owner_request_status) {
                    'approved' => 'Aprobada',
                    'rejected' => 'Rechazada',
                    'pending'  => 'Pendiente',
                    default    => '—',
                };
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 bg-violet-50/70 dark:bg-gray-700/50 border border-violet-100 dark:border-gray-600 rounded-xl px-4 py-3.5 m-6">
                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Nombre</span>
                    <span class="text-sm font-medium text-violet-950 dark:text-gray-100">{{ $user->name }}</span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Email</span>
                    <span class="text-sm font-medium text-violet-950 dark:text-gray-100">{{ $user->email }}</span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Rol</span>
                    <span class="inline-flex w-fit mt-0.5 px-2 py-0.5 rounded-full text-xs font-semibold bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-300 border border-violet-200 dark:border-violet-700">
                        {{ $user->role }}
                    </span>
                </div>

                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Solicitud owner</span>
                    @if ($user->owner_request_status)
                        <span class="inline-flex w-fit mt-0.5 px-2 py-0.5 rounded-full text-xs font-semibold {{ $requestClasses }}">
                            {{ $requestLabel }}
                        </span>
                    @else
                        <span class="text-sm text-violet-300 dark:text-violet-700">—</span>
                    @endif
                </div>
            </div>

            <div class="flex flex-wrap gap-2 px-6 pb-6">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                           border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
                <a href="{{ route('users.edit', $user) }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                           bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
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