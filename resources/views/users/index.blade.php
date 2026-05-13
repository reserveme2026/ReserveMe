<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Usuarios</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg mb-5">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('users.create') }}"
            class="inline-block px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition mb-5">
            Crear usuario
        </a>

        @if ($users->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Rol</th>
                            <th class="px-4 py-3">Plan actual</th>
                            <th class="px-4 py-3">Plan solicitado</th>
                            <th class="px-4 py-3">Estado solicitud</th>
                            <th class="px-4 py-3">Acciones solicitud</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($users as $user)
                            @php
                                $latestOwnerRequest = $user->ownerRequests->sortByDesc('created_at')->first();
                                $pendingOwnerRequest = $user->ownerRequests->where('status', 'pending')->first();

                                $statusClasses = 'bg-gray-100 text-gray-500';

                                if ($latestOwnerRequest) {
                                    if ($latestOwnerRequest->status == 'approved') {
                                        $statusClasses = 'bg-green-100 text-green-700';
                                    }

                                    if ($latestOwnerRequest->status == 'rejected') {
                                        $statusClasses = 'bg-red-100 text-red-700';
                                    }

                                    if ($latestOwnerRequest->status == 'pending') {
                                        $statusClasses = 'bg-yellow-100 text-yellow-700';
                                    }
                                }
                            @endphp

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-gray-700">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->role }}</td>

                                <td class="px-4 py-3 text-gray-700">
                                    @if ($user->owner_plan)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-violet-100 text-violet-700">
                                            {{ $user->owner_plan }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    @if ($latestOwnerRequest)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                            {{ $latestOwnerRequest->requested_plan }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    @if ($latestOwnerRequest)
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusClasses }}">
                                            {{ $latestOwnerRequest->status }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    @if ($pendingOwnerRequest)
                                        <div class="flex flex-wrap gap-1">
                                            <form action="{{ route('ownerRequests.approve', $pendingOwnerRequest) }}" method="post" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition">
                                                    Aceptar
                                                </button>
                                            </form>

                                            <form action="{{ route('ownerRequests.reject', $pendingOwnerRequest) }}" method="post" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition">
                                                    Rechazar
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        <a href="{{ route('users.show', $user) }}"
                                            class="px-2 py-1 text-xs bg-sky-100 hover:bg-sky-200 text-sky-700 rounded-lg transition">
                                            Ver
                                        </a>

                                        <a href="{{ route('users.edit', $user) }}"
                                            class="px-2 py-1 text-xs bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded-lg transition">
                                            Editar
                                        </a>

                                        <form action="{{ route('users.destroy', $user) }}" method="post" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-2 py-1 text-xs bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition">
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
        @else
            <p class="text-gray-500">No hay usuarios registrados.</p>
        @endif
    </div>
</body>

</html>
