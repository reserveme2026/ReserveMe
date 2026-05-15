<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar bloqueo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-violet-950">
                Editar bloqueo de {{ $employee->name }}
            </h1>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

            <div class="p-7">
                <form action="{{ route('employees.blockedTimes.update', [$employee, $blockedTime]) }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-1.5">
                        <label for="block_date" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                            Fecha
                        </label>
                        <input type="date" name="block_date" id="block_date"
                            value="{{ old('block_date', $blockedTime->block_date) }}"
                            class="bg-violet-50/70 border @error('block_date') border-red-400 @else border-violet-100 @enderror rounded-xl px-3.5 py-2.5 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white transition">
                        @error('block_date')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label for="start_time" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                                Hora inicio
                            </label>
                            <input type="time" name="start_time" id="start_time"
                                value="{{ old('start_time', \Carbon\Carbon::parse($blockedTime->start_time)->format('H:i')) }}"
                                class="bg-violet-50/70 border @error('start_time') border-red-400 @else border-violet-100 @enderror rounded-xl px-3.5 py-2.5 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white transition">
                            @error('start_time')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="end_time" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                                Hora fin
                            </label>
                            <input type="time" name="end_time" id="end_time"
                                value="{{ old('end_time', \Carbon\Carbon::parse($blockedTime->end_time)->format('H:i')) }}"
                                class="bg-violet-50/70 border @error('end_time') border-red-400 @else border-violet-100 @enderror rounded-xl px-3.5 py-2.5 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white transition">
                            @error('end_time')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="reason" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                            Motivo
                        </label>
                        <input type="text" name="reason" id="reason"
                            value="{{ old('reason', $blockedTime->reason) }}"
                            placeholder="Motivo del bloqueo"
                            class="bg-violet-50/70 border @error('reason') border-red-400 @else border-violet-100 @enderror rounded-xl px-3.5 py-2.5 text-sm text-violet-950 placeholder-violet-300 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white transition">
                        @error('reason')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="border-t border-violet-50 mt-1"></div>

                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('employees.blockedTimes.index', $employee) }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg bg-violet-600 hover:bg-violet-700 text-white transition-colors duration-150 shadow-sm">
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