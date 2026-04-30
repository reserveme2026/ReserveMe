<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Iniciar sesión</h1>

        <div class="bg-white rounded-xl shadow-md p-6">

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-5">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg mb-5">
                    Revisa los datos introducidos.
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="border @error('email') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('email')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="border @error('password') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('password')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 accent-blue-500 cursor-pointer">
                    <label for="remember" class="text-sm text-gray-600 cursor-pointer">Recordarme</label>
                </div>

                <div class="flex items-center justify-center gap-2 mt-2">
                    <button type="submit"
                        class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition">
                        Entrar
                    </button>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                        Registrarse
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>