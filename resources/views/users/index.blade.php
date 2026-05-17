<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-7xl mx-auto px-4 py-10 flex flex-col gap-6">

        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">Usuarios</h1>
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                       bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Crear usuario
            </a>
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

        @if ($users->count() > 0)
            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-violet-100 dark:border-gray-700">
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Nombre</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Email</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Rol</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Plan actual</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Plan solicitado</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Estado solicitud</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Acciones solicitud</th>
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-violet-50 dark:divide-gray-700">
                            @foreach ($users as $user)
                                @php
                                    $latestOwnerRequest = $user->ownerRequests->sortByDesc('created_at')->first();
                                    $pendingOwnerRequest = $user->ownerRequests->where('status', 'pending')->first();

                                    $statusClasses = 'bg-violet-50 dark:bg-violet-950 text-violet-400 dark:text-violet-500 border border-violet-200 dark:border-violet-800';
                                    $statusLabel = '—';

                                    if ($latestOwnerRequest) {
                                        $statusLabel = $latestOwnerRequest->status;
                                        $statusClasses = match($latestOwnerRequest->status) {
                                            'approved' => 'bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800',
                                            'rejected' => 'bg-red-50 dark:bg-red-950 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800',
                                            'pending'  => 'bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                                            default    => 'bg-violet-50 dark:bg-violet-950 text-violet-400 dark:text-violet-500 border border-violet-200 dark:border-violet-800',
                                        };
                                        $statusLabel = match($latestOwnerRequest->status) {
                                            'approved' => 'Aprobada',
                                            'rejected' => 'Rechazada',
                                            'pending'  => 'Pendiente',
                                            default    => $latestOwnerRequest->status,
                                        };
                                    }
                                @endphp

                                <tr class="hover:bg-violet-50/50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-4 py-3 text-sm font-medium text-violet-950 dark:text-gray-100">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-300 border border-violet-200 dark:border-violet-700">
                                            {{ $user->role }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($user->owner_plan)
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-300 border border-violet-200 dark:border-violet-700">
                                                {{ $user->owner_plan }}
                                            </span>
                                        @else
                                            <span class="text-violet-300 dark:text-violet-700">—</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($latestOwnerRequest)
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-purple-50 dark:bg-purple-950 text-purple-700 dark:text-purple-400 border border-purple-200 dark:border-purple-800">
                                                {{ $latestOwnerRequest->requested_plan }}
                                            </span>
                                        @else
                                            <span class="text-violet-300 dark:text-violet-700">—</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($latestOwnerRequest)
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                                {{ $statusLabel }}
                                            </span>
                                        @else
                                            <span class="text-violet-300 dark:text-violet-700">—</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($pendingOwnerRequest)
                                            <div class="flex flex-wrap gap-1">
                                                <form action="{{ route('ownerRequests.approve', $pendingOwnerRequest) }}" method="post" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs font-semibold bg-emerald-50 dark:bg-emerald-950 hover:bg-emerald-100 dark:hover:bg-emerald-900 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 rounded-lg transition-colors duration-150">
                                                        Aceptar
                                                    </button>
                                                </form>
                                                <form action="{{ route('ownerRequests.reject', $pendingOwnerRequest) }}" method="post" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">
                                                        Rechazar
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-violet-300 dark:text-violet-700">—</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-1">
                                            <a href="{{ route('users.show', $user) }}"
                                                class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">
                                                Ver
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">
                                                Editar
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="post" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">
                                                    Eliminar
                                                </button>
                                            </form>
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
                <p class="text-sm text-violet-400 dark:text-violet-500">No hay usuarios registrados.</p>
            </div>
        @endif

    </div>
</body>

</html>