<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10 flex flex-col gap-6">

        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                Pedir cita en {{ $business->name }}
            </h1>
        </div>

        @if (session('error'))
        <div class="flex items-center gap-2 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm px-4 py-3 rounded-xl">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="flex items-center gap-2 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm px-4 py-3 rounded-xl">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Revisa los datos introducidos.
        </div>
        @endif

        <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
            <div class="p-6 flex flex-col gap-5">

                <form action="{{ route('businesses.appointments.store', $business) }}" method="post" class="flex flex-col gap-5">
                    @csrf

                    <div class="flex flex-col gap-1">
                        <label for="employee_id" class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Empleado</label>
                        <select name="employee_id" id="employee_id"
                            class="border @error('employee_id') border-red-300 dark:border-red-700 @else border-violet-200 dark:border-gray-600 @enderror bg-violet-50/70 dark:bg-gray-700 text-violet-950 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:ring-violet-600 transition">
                            <option value="">Selecciona un empleado</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" @if (old('employee_id')==$employee->id) selected @endif>
                                {{ $employee->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                        <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="service_id" class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Servicio</label>
                        <select name="service_id" id="service_id"
                            class="border @error('service_id') border-red-300 dark:border-red-700 @else border-violet-200 dark:border-gray-600 @enderror bg-violet-50/70 dark:bg-gray-700 text-violet-950 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:ring-violet-600 transition">
                            <option value="">Selecciona un servicio</option>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}" @if (old('service_id')==$service->id) selected @endif>
                                {{ $service->name }} — {{ $service->duration_minutes }} min — {{ $service->price }} €
                            </option>
                            @endforeach
                        </select>
                        @error('service_id')
                        <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="hidden" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}">
                    <input type="hidden" name="time" id="time" value="{{ old('time') }}">

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">
                                    Fecha
                                </label>
                                <div class="flex gap-2">
                                    <button type="button" id="prev_dates"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150 cursor-pointer">
                                        Anterior
                                    </button>
                                    <button type="button" id="next_dates"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150 cursor-pointer">
                                        Siguiente
                                    </button>
                                </div>
                            </div>

                            <div id="date_options" class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-2 cursor-pointer"></div>

                            @error('appointment_date')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">
                                Hora
                            </label>
                            <div id="time_options" class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-2 mt-2"></div>
                            <p id="time_message" class="text-xs text-violet-500 dark:text-violet-400 mt-2"></p>

                            @error('time')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="notes" class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Notas</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="border @error('notes') border-red-300 dark:border-red-700 @else border-violet-200 dark:border-gray-600 @enderror bg-violet-50/70 dark:bg-gray-700 text-violet-950 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 dark:focus:ring-violet-600 transition resize-none">{{ old('notes') }}</textarea>
                        @error('notes')
                        <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <a href="{{ route('businesses.show', $business) }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Crear cita
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script>
        const employeeSelect = document.getElementById('employee_id');
        const serviceSelect = document.getElementById('service_id');
        const dateInput = document.getElementById('appointment_date');
        const timeInput = document.getElementById('time');
        const dateOptions = document.getElementById('date_options');
        const timeOptions = document.getElementById('time_options');
        const prevDatesButton = document.getElementById('prev_dates');
        const nextDatesButton = document.getElementById('next_dates');
        const timeMessage = document.getElementById('time_message');

        let startDay = 0;

        const dayNames = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];

        function twoNumbers(number) {
            return number < 10 ? '0' + number : '' + number;
        }

        function dateValue(date) {
            return date.getFullYear() + '-' + twoNumbers(date.getMonth() + 1) + '-' + twoNumbers(date.getDate());
        }

        function dateText(date) {
            return twoNumbers(date.getDate()) + '/' + twoNumbers(date.getMonth() + 1);
        }

        function clearTimes() {
            timeOptions.innerHTML = '';
            timeInput.value = '';
            timeMessage.textContent = '';
        }

        function isDark() {
            return document.documentElement.classList.contains('dark');
        }

        function showDates() {
            dateOptions.innerHTML = '';

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            for (let i = 0; i < 7; i++) {
                const date = new Date(today);
                date.setDate(today.getDate() + startDay + i);
                const value = dateValue(date);

                const button = document.createElement('button');
                button.type = 'button';

                if (dateInput.value == value) {
                    button.className = 'border rounded-xl px-3 py-2 text-left bg-violet-600 text-white border-violet-600 shadow-sm cursor-pointer';
                } else {
                    button.className = isDark()
                        ? 'border rounded-xl px-3 py-2 text-left bg-gray-700 text-violet-300 border-gray-600 hover:bg-gray-600 cursor-pointer'
                        : 'border rounded-xl px-3 py-2 text-left bg-white text-violet-700 border-violet-200 hover:bg-violet-50 cursor-pointer';
                }

                button.innerHTML = `
                    <span class="block text-[10px] font-bold uppercase tracking-widest">${dayNames[date.getDay()]}</span>
                    <span class="block text-sm font-semibold">${dateText(date)}</span>
                `;

                button.addEventListener('click', function () {
                    dateInput.value = value;
                    clearTimes();
                    showDates();
                    loadTimes();
                });

                dateOptions.appendChild(button);
            }

            prevDatesButton.disabled = startDay == 0;
        }

        function showTimes(times) {
            timeOptions.innerHTML = '';

            times.forEach(function (time) {
                const button = document.createElement('button');
                button.type = 'button';

                if (timeInput.value == time) {
                    button.className = 'border rounded-xl px-3 py-2 text-sm font-semibold bg-violet-600 text-white border-violet-600 shadow-sm cursor-pointer';
                } else {
                    button.className = isDark()
                        ? 'border rounded-xl px-3 py-2 text-sm font-semibold bg-gray-700 text-violet-300 border-gray-600 hover:bg-gray-600 cursor-pointer'
                        : 'border rounded-xl px-3 py-2 text-sm font-semibold bg-white text-violet-700 border-violet-200 hover:bg-violet-50 cursor-pointer';
                }

                button.textContent = time;

                button.addEventListener('click', function () {
                    timeInput.value = time;
                    showTimes(times);
                });

                timeOptions.appendChild(button);
            });
        }

        function loadTimes() {
            const employeeId = employeeSelect.value;
            const serviceId = serviceSelect.value;
            const appointmentDate = dateInput.value;

            clearTimes();

            if (!employeeId || !serviceId || !appointmentDate) return;

            timeMessage.textContent = 'Cargando horas disponibles...';

            fetch("{{ route('businesses.appointments.availableTimes', $business) }}?employee_id=" + employeeId + "&service_id=" + serviceId + "&appointment_date=" + appointmentDate)
                .then(response => response.json())
                .then(times => {
                    timeMessage.textContent = '';
                    if (times.length == 0) {
                        timeMessage.textContent = 'No hay horas disponibles para esa fecha';
                        return;
                    }
                    showTimes(times);
                })
                .catch(() => {
                    clearTimes();
                    timeMessage.textContent = 'No se han podido cargar las horas disponibles';
                });
        }

        prevDatesButton.addEventListener('click', function () {
            if (startDay >= 7) {
                startDay -= 7;
                dateInput.value = dateValue(new Date(new Date().setDate(new Date().getDate() + startDay)));
                showDates();
                loadTimes();
            }
        });

        nextDatesButton.addEventListener('click', function () {
            startDay += 7;
            dateInput.value = dateValue(new Date(new Date().setDate(new Date().getDate() + startDay)));
            showDates();
            loadTimes();
        });

        employeeSelect.addEventListener('change', loadTimes);
        serviceSelect.addEventListener('change', loadTimes);

        if (!dateInput.value) {
            dateInput.value = dateValue(new Date());
        } else {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const selectedDate = new Date(dateInput.value);
            selectedDate.setHours(0, 0, 0, 0);
            const daysDifference = Math.floor((selectedDate - today) / (1000 * 60 * 60 * 24));
            if (daysDifference > 0) startDay = Math.floor(daysDifference / 7) * 7;
        }

        showDates();
        loadTimes();
    </script>
</body>

</html>