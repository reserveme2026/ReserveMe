<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        {{-- Page header --}}
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-violet-950">
                Editar cita en {{ $business->name }}
            </h1>
        </div>

        {{-- Alerts --}}
        @if (session('error'))
            <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Revisa los datos introducidos.
            </div>
        @endif

        {{-- Form card --}}
        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
            <div class="p-6 flex flex-col gap-5">

                <form action="{{ route('businesses.appointments.update', [$business, $appointment]) }}" method="post" class="flex flex-col gap-5">
                    @csrf
                    @method('PUT')

                    {{-- Empleado --}}
                    <div class="flex flex-col gap-1">
                        <label for="employee_id" class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Empleado</label>
                        <select name="employee_id" id="employee_id"
                            class="border @error('employee_id') border-red-300 @else border-violet-200 @enderror bg-violet-50/70 rounded-lg px-3 py-2 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                            <option value="">Selecciona un empleado</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @if (old('employee_id', $appointment->employee_id) == $employee->id) selected @endif>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Servicio --}}
                    <div class="flex flex-col gap-1">
                        <label for="service_id" class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Servicio</label>
                        <select name="service_id" id="service_id"
                            class="border @error('service_id') border-red-300 @else border-violet-200 @enderror bg-violet-50/70 rounded-lg px-3 py-2 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                            <option value="">Selecciona un servicio</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @if (old('service_id', $appointment->service_id) == $service->id) selected @endif>
                                    {{ $service->name }} — {{ $service->duration_minutes }} min — {{ $service->price }} €
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Fecha y hora --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <label for="appointment_date" class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Fecha</label>
                            <input type="date" name="appointment_date" id="appointment_date"
                                value="{{ old('appointment_date', $appointment->appointment_date) }}"
                                class="border @error('appointment_date') border-red-300 @else border-violet-200 @enderror bg-violet-50/70 rounded-lg px-3 py-2 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                            @error('appointment_date')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="time" class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Hora</label>
                            <input type="time" name="time" id="time" step="900"
                                value="{{ old('time', \Carbon\Carbon::parse($appointment->start_time)->format('H:i')) }}"
                                class="border @error('time') border-red-300 @else border-violet-200 @enderror bg-violet-50/70 rounded-lg px-3 py-2 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                            @error('time')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Estado (solo owner/admin) --}}
                    @if (auth()->user()->role == 'owner' || auth()->user()->role == 'admin')
                        <div class="flex flex-col gap-1">
                            <label for="status" class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Estado</label>
                            <select name="status" id="status"
                                class="border @error('status') border-red-300 @else border-violet-200 @enderror bg-violet-50/70 rounded-lg px-3 py-2 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                                <option value="pending" @if (old('status', $appointment->status) == 'pending') selected @endif>Pendiente</option>
                                <option value="confirmed" @if (old('status', $appointment->status) == 'confirmed') selected @endif>Confirmada</option>
                                <option value="cancelled" @if (old('status', $appointment->status) == 'cancelled') selected @endif>Cancelada</option>
                            </select>
                            @error('status')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif

                    {{-- Notas --}}
                    <div class="flex flex-col gap-1">
                        <label for="notes" class="text-[10px] font-bold uppercase tracking-widest text-violet-400">Notas</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="border @error('notes') border-red-300 @else border-violet-200 @enderror bg-violet-50/70 rounded-lg px-3 py-2 text-sm text-violet-950 focus:outline-none focus:ring-2 focus:ring-violet-400 transition resize-none">{{ old('notes', $appointment->notes) }}</textarea>
                        @error('notes')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 pt-1">
                        <a href="{{ route('businesses.appointments.index', $business) }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                                   border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                                   bg-purple-500 hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Actualizar cita
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</body>

</html>