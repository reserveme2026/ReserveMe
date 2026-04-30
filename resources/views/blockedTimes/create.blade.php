<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear bloqueo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear bloqueo para {{ $employee->name }}</h1>

        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('employees.blockedTimes.store', $employee) }}" method="post" class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="block_date" class="text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="block_date" id="block_date" value="{{ old('block_date') }}"
                        class="border @error('block_date') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('block_date')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="start_time" class="text-sm font-medium text-gray-700">Hora inicio</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                        class="border @error('start_time') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('start_time')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="end_time" class="text-sm font-medium text-gray-700">Hora fin</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                        class="border @error('end_time') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('end_time')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="reason" class="text-sm font-medium text-gray-700">Motivo</label>
                    <input type="text" name="reason" id="reason" value="{{ old('reason') }}"
                        class="border @error('reason') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    @error('reason')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex items-center justify-center gap-2 mt-2">
                    <button type="submit"
                        class="px-4 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition">
                        Crear
                    </button>
                    <a href="{{ route('employees.blockedTimes.index', $employee) }}"
                        class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                        Volver
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>