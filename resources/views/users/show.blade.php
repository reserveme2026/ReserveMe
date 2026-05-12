<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle usuario</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-lg mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detalle usuario</h1>

        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3">

            @php
                $requestClasses = match($user->owner_request_status) {
                    'approved' => 'bg-green-100 text-green-700',
                    'rejected' => 'bg-red-100 text-red-700',
                    'pending'  => 'bg-yellow-100 text-yellow-700',
                    default    => 'bg-gray-100 text-gray-500',
                };
            @endphp

            <div class="flex items-center gap-2 text-sm">
                <span class="font-medium text-gray-500 w-36">Nombre</span>
                <span class="text-gray-800">{{ $user->name }}</span>
            </div>

            <div class="flex items-center gap-2 text-sm">
                <span class="font-medium text-gray-500 w-36">Email</span>
                <span class="text-gray-800">{{ $user->email }}</span>
            </div>

            <div class="flex items-center gap-2 text-sm">
                <span class="font-medium text-gray-500 w-36">Rol</span>
                <span class="text-gray-800">{{ $user->role }}</span>
            </div>

            <div class="flex items-center gap-2 text-sm">
                <span class="font-medium text-gray-500 w-36">Solicitud owner</span>
                @if ($user->owner_request_status)
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $requestClasses }}">
                        {{ $user->owner_request_status }}
                    </span>
                @else
                    <span class="text-gray-400">—</span>
                @endif
            </div>

            <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('users.edit', $user) }}"
                    class="px-4 py-2 text-sm bg-yellow-100 hover:bg-yellow-200 text-yellow-700 font-medium rounded-lg transition">
                    Editar
                </a>

                <a href="{{ route('users.index') }}"
                    class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                    Volver
                </a>
            </div>

        </div>
    </div>

</body>

</html>