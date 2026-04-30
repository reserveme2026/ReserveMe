<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Negocio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Negocio</h1>

        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('businesses.store') }}" method="post" class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="name" class="text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="border @error('name') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('name')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="description" class="text-sm font-medium text-gray-700">Descripción</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}"
                        class="border @error('description') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('description')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="phone" class="text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="border @error('phone') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('phone')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="address" class="text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                        class="border @error('address') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('address')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}"
                        class="border @error('email') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('email')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit"
                    class="mt-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition">
                    Crear
                </button>

            </form>
        </div>
    </div>

</body>

</html>