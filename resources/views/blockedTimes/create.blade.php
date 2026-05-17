<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear bloqueo</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">Crear bloqueo para {{ $employee->name }}</h1>

        <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
            <div class="p-6">

                <form action="{{ route('employees.blockedTimes.store', $employee) }}" method="post" class="flex flex-col gap-5">
                    @csrf

                    <div class="flex flex-col gap-1">
                        <label for="block_date" class="text-sm font-medium text-violet-700 dark:text-violet-400">Fecha</label>
                        <input type="date" name="block_date" id="block_date" value="{{ old('block_date') }}"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('block_date') border-red-300 dark:border-red-600 @else border-violet-200 dark:border-gray-600 @enderror
                                   rounded-lg px-3 py-2 text-sm text-violet-950 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:bg-gray-600 transition">
                        @error('block_date')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="start_time" class="text-sm font-medium text-violet-700 dark:text-violet-400">Hora inicio</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('start_time') border-red-300 dark:border-red-600 @else border-violet-200 dark:border-gray-600 @enderror
                                   rounded-lg px-3 py-2 text-sm text-violet-950 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:bg-gray-600 transition">
                        @error('start_time')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="end_time" class="text-sm font-medium text-violet-700 dark:text-violet-400">Hora fin</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('end_time') border-red-300 dark:border-red-600 @else border-violet-200 dark:border-gray-600 @enderror
                                   rounded-lg px-3 py-2 text-sm text-violet-950 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:bg-gray-600 transition">
                        @error('end_time')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="reason" class="text-sm font-medium text-violet-700 dark:text-violet-400">Motivo</label>
                        <input type="text" name="reason" id="reason" value="{{ old('reason') }}"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('reason') border-red-300 dark:border-red-600 @else border-violet-200 dark:border-gray-600 @enderror
                                   rounded-lg px-3 py-2 text-sm text-violet-950 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:bg-gray-600 transition">
                        @error('reason')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex items-center justify-center gap-2 mt-2">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white rounded-lg transition-colors duration-150 shadow-sm">
                            Crear
                        </button>
                        <a href="{{ route('employees.blockedTimes.index', $employee) }}"
                            class="px-4 py-2 text-sm font-semibold border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 rounded-lg transition-colors duration-150">
                            <svg class="w-3.5 h-3.5 inline-block mr-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
@include('components.footer')
</body>

</html>