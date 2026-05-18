<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloqueos</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @include('components.header')

    <div class="max-w-4xl mx-auto px-4 py-10 flex flex-col gap-6">

        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">Bloqueos de {{ $employee->name }}</h1>
            <a href="{{ route('employees.blockedTimes.create', $employee) }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                       bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white transition-colors duration-150 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Crear bloqueo
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-2 bg-emerald-50 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 text-sm px-4 py-3 rounded-xl">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($blockedTimes->count() > 0)

            <div class="hidden lg:block bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-violet-100 dark:border-gray-700">
                            <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Fecha</th>
                            <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Hora inicio</th>
                            <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Hora fin</th>
                            <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Motivo</th>
                            <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-violet-50 dark:divide-gray-700">
                        @foreach ($blockedTimes as $blockedTime)
                            <tr class="hover:bg-violet-50/50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm font-medium text-violet-950 dark:text-gray-100">{{ $blockedTime->block_date }}</td>
                                <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $blockedTime->start_time }}</td>
                                <td class="px-4 py-3 text-sm text-violet-800 dark:text-gray-300">{{ $blockedTime->end_time }}</td>
                                <td class="px-4 py-3 text-sm text-violet-600 dark:text-violet-400 max-w-[200px] truncate">{{ $blockedTime->reason }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        <a href="{{ route('employees.blockedTimes.show', [$employee, $blockedTime]) }}"
                                            class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Ver</a>
                                        <a href="{{ route('employees.blockedTimes.edit', [$employee, $blockedTime]) }}"
                                            class="px-2 py-1 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Editar</a>
                                        <form action="{{ route('employees.blockedTimes.destroy', [$employee, $blockedTime]) }}" method="post" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-2 py-1 text-xs font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="lg:hidden flex flex-col gap-4">
                @foreach ($blockedTimes as $blockedTime)
                    <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">
                        <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>
                        <div class="p-4 flex flex-col gap-3">

                            <div>
                                <p class="text-base font-bold text-violet-950 dark:text-gray-100">{{ $blockedTime->block_date }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-y-2 text-sm">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Hora inicio</span>
                                    <p class="text-violet-800 dark:text-gray-300">{{ $blockedTime->start_time }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Hora fin</span>
                                    <p class="text-violet-800 dark:text-gray-300">{{ $blockedTime->end_time }}</p>
                                </div>
                                @if ($blockedTime->reason)
                                <div class="col-span-2">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-400 dark:text-violet-500">Motivo</span>
                                    <p class="text-violet-800 dark:text-gray-300">{{ $blockedTime->reason }}</p>
                                </div>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-1 border-t border-violet-50 dark:border-gray-700">
                                <a href="{{ route('employees.blockedTimes.show', [$employee, $blockedTime]) }}"
                                    class="text-center px-3 py-1.5 text-sm font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Ver</a>
                                <a href="{{ route('employees.blockedTimes.edit', [$employee, $blockedTime]) }}"
                                    class="text-center px-3 py-1.5 text-sm font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">Editar</a>
                                <form action="{{ route('employees.blockedTimes.destroy', [$employee, $blockedTime]) }}" method="post" class="col-span-2">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full px-3 py-1.5 text-sm font-semibold bg-red-50 dark:bg-red-950 hover:bg-red-100 dark:hover:bg-red-900 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg transition-colors duration-150">Eliminar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm px-6 py-10 text-center">
                <p class="text-sm text-violet-400 dark:text-violet-500">Este empleado no tiene bloqueos creados.</p>
            </div>
        @endif

        <div>
            <a href="{{ route('businesses.employees.index', $employee->business_id) }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                       border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

    </div>
</body>

</html>