<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Negocio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-violet-50 min-h-screen">
    @include('components.header')

    <div class="max-w-2xl mx-auto px-4 py-10">

        {{-- Page header --}}
        <div class="flex items-center gap-3 mb-6">
            <h1 class="text-2xl font-bold text-violet-950">
                Crear <span class="text-violet-600">negocio</span>
            </h1>
        </div>

        {{-- Form card --}}
        <div class="bg-white border border-violet-100 rounded-2xl shadow-sm overflow-hidden">

            {{-- Top accent bar --}}
            <div class="h-1 w-full bg-gradient-to-r from-violet-500 to-purple-500"></div>

            <div class="p-7">
                <form action="{{ route('businesses.store') }}" method="post" class="flex flex-col gap-5">
                    @csrf

                    {{-- Nombre + Teléfono en dos columnas --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div class="flex flex-col gap-1.5">
                            <label for="name" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                                Nombre
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Nombre del negocio"
                                class="bg-violet-50/70 border @error('name') border-red-400 @else border-violet-100 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 placeholder-violet-300
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                       focus:bg-white transition">
                            @error('name')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="phone" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                                Teléfono
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Número de teléfono"
                                class="bg-violet-50/70 border @error('phone') border-red-400 @else border-violet-100 @enderror
                                       rounded-xl px-3.5 py-2.5 text-sm text-violet-950 placeholder-violet-300
                                       focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                       focus:bg-white transition">
                            @error('phone')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    {{-- Descripción --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="description" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                            Descripción
                        </label>
                        <input type="text" name="description" id="description" value="{{ old('description') }}"
                            placeholder="Breve descripción del negocio"
                            class="bg-violet-50/70 border @error('description') border-red-400 @else border-violet-100 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 placeholder-violet-300
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                   focus:bg-white transition">
                        @error('description')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Dirección --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="address" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                            Dirección
                        </label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                            placeholder="Calle, número, ciudad"
                            class="bg-violet-50/70 border @error('address') border-red-400 @else border-violet-100 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 placeholder-violet-300
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                   focus:bg-white transition">
                        @error('address')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                            Email
                        </label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                            placeholder="correo@negocio.com"
                            class="bg-violet-50/70 border @error('email') border-red-400 @else border-violet-100 @enderror
                                   rounded-xl px-3.5 py-2.5 text-sm text-violet-950 placeholder-violet-300
                                   focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-transparent
                                   focus:bg-white transition">
                        @error('email')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-violet-50 mt-1"></div>

                    {{-- Footer actions --}}
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('businesses.index') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                                   border border-violet-200 text-violet-600 hover:bg-violet-50 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-lg
                                   bg-violet-600 hover:bg-violet-700 text-white transition-colors duration-150 shadow-sm cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Crear negocio
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>