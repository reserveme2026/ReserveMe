<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen flex flex-col transition-colors duration-200">
    @include('components.header')

    <main class="flex-1">
        <div class="max-w-md mx-auto px-4 py-10 flex flex-col gap-6">

            <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">Crear cuenta</h1>

            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                <div class="p-6">

                    @if ($errors->any())
                        <div class="flex items-center gap-2 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm px-4 py-3 rounded-xl mb-5">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Revisa los datos introducidos.
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="post" class="flex flex-col gap-5">
                        @csrf

                        <div class="flex flex-col gap-1">
                            <label for="name" class="text-sm font-medium text-violet-700 dark:text-violet-400">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="border @error('name') border-red-300 dark:border-red-700 @else border-violet-200 dark:border-gray-600 @enderror bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:ring-violet-600 transition">
                            @error('name')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="email" class="text-sm font-medium text-violet-700 dark:text-violet-400">Correo electrónico</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="border @error('email') border-red-300 dark:border-red-700 @else border-violet-200 dark:border-gray-600 @enderror bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:ring-violet-600 transition">
                            @error('email')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="password" class="text-sm font-medium text-violet-700 dark:text-violet-400">Contraseña</label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="w-full border @error('password') border-red-300 dark:border-red-700 @else border-violet-200 dark:border-gray-600 @enderror bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:ring-violet-600 transition">
                                <button type="button" onclick="togglePassword('password', 'eye-icon-1')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-violet-400 hover:text-violet-600 dark:text-violet-500 dark:hover:text-violet-300 cursor-pointer">
                                    <svg id="eye-icon-1" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="password_confirmation" class="text-sm font-medium text-violet-700 dark:text-violet-400">Confirmar contraseña</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full border border-violet-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-3 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:ring-violet-600 transition">
                                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-violet-400 hover:text-violet-600 dark:text-violet-500 dark:hover:text-violet-300 cursor-pointer">
                                    <svg id="eye-icon-2" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center gap-2 mt-2">
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 text-sm font-semibold bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white rounded-lg transition-colors duration-150 shadow-sm cursor-pointer">
                                Registrarse
                            </button>
                            <a href="{{ route('login') }}"
                                class="w-full sm:w-auto text-center px-4 py-2 text-sm font-semibold border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 rounded-lg transition-colors duration-150">
                                Ya tengo cuenta
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

    @include('components.footer')

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';

            icon.innerHTML = isHidden
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    </script>

</body>

</html>