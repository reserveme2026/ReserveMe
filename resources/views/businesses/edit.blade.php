<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Negocio</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 dark:bg-gray-900 min-h-screen flex flex-col transition-colors duration-200">
    @include('components.header')

    <main class="flex-1">
        <div class="max-w-2xl mx-auto px-4 py-10">

            <div class="flex items-center gap-3 mb-6">
                <h1 class="text-2xl font-bold text-violet-950 dark:text-violet-200">
                    Editar <span class="text-violet-600 dark:text-violet-400">negocio</span>
                </h1>
            </div>

            <div class="bg-white dark:bg-gray-800 border border-violet-100 dark:border-gray-600 rounded-2xl shadow-sm overflow-hidden">

                <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

                <div class="p-7">
                    <form action="{{ route('businesses.update', $business) }}" method="post" class="flex flex-col gap-5" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="flex flex-col gap-1.5">
                                <label for="name" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                    Nombre
                                </label>
                                <input type="text" name="name" id="name" value="{{ $business->name }}"
                                    placeholder="Nombre del negocio"
                                    class="bg-violet-50/70 dark:bg-gray-700 border @error('name') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                           rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500
                                           focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                           focus:bg-white dark:focus:bg-gray-600 transition">
                                @error('name')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="phone" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                    Teléfono
                                </label>
                                <input type="text" name="phone" id="phone" value="{{ $business->phone }}"
                                    placeholder="Número de teléfono"
                                    class="bg-violet-50/70 dark:bg-gray-700 border @error('phone') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                           rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500
                                           focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                           focus:bg-white dark:focus:bg-gray-600 transition">
                                @error('phone')
                                <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="description" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Descripción
                            </label>
                            <input type="text" name="description" id="description" value="{{ $business->description }}"
                                placeholder="Breve descripción del negocio"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('description') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                       focus:bg-white dark:focus:bg-gray-600 transition">
                            @error('description')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="address" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Dirección
                            </label>
                            <input type="text" name="address" id="address" value="{{ $business->address }}"
                                placeholder="Calle, número, ciudad"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('address') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                       focus:bg-white dark:focus:bg-gray-600 transition">
                            @error('address')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="email" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Email
                            </label>
                            <input type="text" name="email" id="email" value="{{ $business->email }}"
                                placeholder="correo@negocio.com"
                                class="bg-violet-50/70 dark:bg-gray-700 border @error('email') border-red-400 dark:border-red-600 @else border-violet-100 dark:border-gray-600 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 dark:text-gray-100 placeholder-violet-300 dark:placeholder-gray-500
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                       focus:bg-white dark:focus:bg-gray-600 transition">
                            @error('email')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        @if ($business->image)
                        <div class="flex flex-col gap-1.5">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Foto actual
                            </span>
                            <img src="{{ asset('storage/' . $business->image) }}"
                                alt="{{ $business->name }}"
                                class="w-full max-w-xs h-48 object-cover rounded-xl border border-violet-200 dark:border-gray-600">
                        </div>
                        @endif

                        <div class="flex flex-col gap-1.5">
                            <label for="image" class="text-[10px] font-bold uppercase tracking-widest text-violet-500 dark:text-violet-400">
                                Foto del negocio
                            </label>
                            <input type="file" name="image" id="image"
                                class="border @error('image') border-red-300 dark:border-red-600 @else border-violet-200 dark:border-gray-600 @enderror
                                       bg-violet-50/70 dark:bg-gray-700 rounded-lg px-3 py-2 text-sm text-violet-950 dark:text-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 transition">
                            @error('image')
                            <small class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="border-t border-violet-50 dark:border-gray-700 mt-1"></div>

                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('businesses.index') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                                       border border-violet-200 dark:border-gray-600 text-violet-600 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Volver
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                                       bg-violet-600 hover:bg-violet-700 dark:bg-violet-700 dark:hover:bg-violet-600 text-white transition-colors duration-150 shadow-sm cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Confirmar cambios
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>

</html>