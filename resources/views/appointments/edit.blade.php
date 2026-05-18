<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cita</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                Editar cita en {{ $business->name }}
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
                <form action="{{ route('businesses.appointments.update', [$business, $appointment]) }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-1.5">
                        <label for="employee_id" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                            Empleado
                        </label>
                        <select name="employee_id" id="employee_id"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('employee_id') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @if (old('employee_id', $appointment->employee_id) == $employee->id) selected @endif>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="service_id" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                            Servicio
                        </label>
                        <select name="service_id" id="service_id"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('service_id') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @if (old('service_id', $appointment->service_id) == $service->id) selected @endif>
                                    {{ $service->name }} — {{ $service->duration_minutes }} min — {{ $service->price }} €
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label for="appointment_date" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Fecha
                            </label>
                            <input type="date" name="appointment_date" id="appointment_date"
                                value="{{ old('appointment_date', $appointment->appointment_date) }}"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('appointment_date') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                            @error('appointment_date')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="time" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Hora inicio
                            </label>
                            <input type="time" name="time" id="time"
                                value="{{ old('time', \Carbon\Carbon::parse($appointment->start_time)->format('H:i')) }}"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('time') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                            @error('time')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    @if (auth()->user()->role == 'owner')
                        <div class="flex flex-col gap-1.5">
                            <label for="status" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Estado
                            </label>
                            <select name="status" id="status"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('status') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition">
                                <option value="pending" @if (old('status', $appointment->status) == 'pending') selected @endif>Pendiente</option>
                                <option value="confirmed" @if (old('status', $appointment->status) == 'confirmed') selected @endif>Confirmada</option>
                                <option value="cancelled" @if (old('status', $appointment->status) == 'cancelled') selected @endif>Cancelada</option>
                            </select>
                            @error('status')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif

                    <div class="flex flex-col gap-1.5">
                        <label for="notes" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                            Notas
                        </label>
                        <textarea name="notes" id="notes" rows="3"
                            class="bg-violet-50/70 dark:bg-gray-700 border @error('notes') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent focus:bg-white dark:focus:bg-gray-600 transition resize-none"
                            placeholder="Notas de la cita">{{ old('notes', $appointment->notes) }}</textarea>
                        @error('notes')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="border-t border-violet-50 dark:border-gray-700 mt-1"></div>

                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ auth()->user()->role === 'client' ? route('appointments.myAppointments') : route('businesses.appointments.index', $business) }}"
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