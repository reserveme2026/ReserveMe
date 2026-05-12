<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-md mx-auto px-4 py-10 flex flex-col gap-6">

        <h1 class="text-2xl font-bold text-violet-950">Editar usuario</h1>

        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
            <div class="p-6">

                @if ($errors->any())
                    <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Revisa los datos introducidos.
                    </div>
                @endif

                <form action="{{ route('users.update', $user) }}" method="post" class="flex flex-col gap-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-1">
                        <label for="name" class="text-sm font-medium text-violet-700">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="border @error('name') border-red-300 @else border-violet-200 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                        @error('name')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="email" class="text-sm font-medium text-violet-700">Correo electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="border @error('email') border-red-300 @else border-violet-200 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                        @error('email')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password" class="text-sm font-medium text-violet-700">Nueva contraseña</label>
                        <input type="password" name="password" id="password"
                            class="border @error('password') border-red-300 @else border-violet-200 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                        @error('password')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password_confirmation" class="text-sm font-medium text-violet-700">Confirmar nueva contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="border border-violet-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="role" class="text-sm font-medium text-violet-700">Rol</label>
                        <select name="role" id="role"
                            class="border @error('role') border-red-300 @else border-violet-200 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                            <option value="owner" @if (old('role', $user->role) == 'owner') selected @endif>Owner</option>
                            <option value="client" @if (old('role', $user->role) == 'client') selected @endif>Client</option>
                        </select>
                        @error('role')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex items-center justify-center gap-2 mt-2">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors duration-150 shadow-sm">
                            Actualizar
                        </button>
                        <a href="{{ route('users.index') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                                   border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>

</body>

</html>