<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Negocio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Negocio</h1>

        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('businesses.update', $business) }}" method="post" class="flex flex-col gap-5">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-1">
                    <label for="name" class="text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ $business->name }}"
                        class="border @error('name') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('name')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="description" class="text-sm font-medium text-gray-700">Descripción</label>
                    <input type="text" name="description" id="description" value="{{ $business->description }}"
                        class="border @error('description') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('description')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="phone" class="text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ $business->phone }}"
                        class="border @error('phone') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('phone')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="address" class="text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="address" id="address" value="{{ $business->address }}"
                        class="border @error('address') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('address')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" id="email" value="{{ $business->email }}"
                        class="border @error('email') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('email')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                @if (auth()->user()->role == 'admin')
                <div class="flex flex-col gap-1">
                    <label for="owner_id" class="text-sm font-medium text-gray-700">Propietario</label>
                    <select name="owner_id" id="owner_id"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ($user->id == $business->owner_id) selected @endif>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="flex items-center justify-center gap-2 mt-2">
                    <a href="{{ route('businesses.index') }}" class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                            Volver
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition">
                        Confirmar los cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>