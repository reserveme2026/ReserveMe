<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar bloqueo</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                Editar bloqueo de {{ $employee->name }}
            </h1>
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

        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm px-4 py-3 rounded-xl">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

            <div class="p-7">
                <form action="{{ route('employees.blockedTimes.update', [$employee, $blockedTime]) }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-1.5">
                        <label for="block_date" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                            Fecha
                        </label>
                        <input type="date" name="block_date" id="block_date"
                            value="{{ old('block_date', $blockedTime->block_date) }}"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('block_date') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                        @error('block_date')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label for="start_time" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Hora inicio
                            </label>
                            <input type="time" name="start_time" id="start_time"
                                value="{{ old('start_time', \Carbon\Carbon::parse($blockedTime->start_time)->format('H:i')) }}"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('start_time') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                            @error('start_time')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="end_time" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Hora fin
                            </label>
                            <input type="time" name="end_time" id="end_time"
                                value="{{ old('end_time', \Carbon\Carbon::parse($blockedTime->end_time)->format('H:i')) }}"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('end_time') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                            @error('end_time')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="reason" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                            Motivo
                        </label>
                        <input type="text" name="reason" id="reason"
                            value="{{ old('reason', $blockedTime->reason) }}"
                            placeholder="Motivo del bloqueo"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('reason') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                        @error('reason')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="border-t border-violet-50 dark:border-gray-700 mt-1"></div>

                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('employees.blockedTimes.index', $employee) }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg bg-violet-600 hover:bg-violet-700 dark:bg-violet-700 dark:hover:bg-violet-600 text-white transition-colors duration-150 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>