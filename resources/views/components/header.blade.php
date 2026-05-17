<nav
    class="bg-white dark:bg-gray-800 border-b border-violet-100 dark:border-gray-700 shadow-sm mb-6 transition-colors duration-200">

    {{-- Barra principal --}}
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">

        {{-- Logo --}}
        <a href="{{ route('businesses.index') }}"
            class="text-xl font-bold text-violet-700 dark:text-violet-400 hover:text-violet-900 dark:hover:text-violet-300 transition-colors duration-150 shrink-0">
            ReservMe
        </a>

        {{-- Links desktop --}}
        <div class="hidden md:flex items-center gap-4 flex-1">
            <a href="{{ route('businesses.index') }}"
                class="text-sm text-violet-500 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-medium transition-colors duration-150 whitespace-nowrap">
                @auth
                    @if (auth()->user()->role == 'owner' || auth()->user()->role == 'employee')
                        Mis negocios
                    @else
                        Ver todos los negocios
                    @endif
                @else
                    Ver todos los negocios
                @endauth
            </a>

            @auth
                @if (auth()->user()->role == 'client')
                    <a href="{{ route('appointments.myAppointments') }}"
                        class="text-sm text-violet-500 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-medium transition-colors duration-150 whitespace-nowrap">
                        Mis citas
                    </a>
                    <a href="{{ route('ownerRequests.plans') }}"
                        class="text-sm text-violet-500 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-medium transition-colors duration-150 whitespace-nowrap">
                        Hazte owner
                    </a>
                @endif

                @if (auth()->user()->role == 'owner')
                    <a href="{{ route('ownerRequests.plans') }}"
                        class="text-sm text-violet-500 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-medium transition-colors duration-150 whitespace-nowrap">
                        Actualizar plan
                    </a>
                    <a href="{{ route('businesses.create') }}"
                        class="text-sm text-violet-500 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-medium transition-colors duration-150 whitespace-nowrap">
                        Crear nuevo negocio
                    </a>
                @endif

                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('users.index') }}"
                        class="text-sm text-violet-500 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-medium transition-colors duration-150 whitespace-nowrap">
                        Usuarios
                    </a>
                @endif
            @endauth
        </div>

        {{-- Acciones desktop --}}
        <div class="hidden md:flex items-center gap-2 shrink-0">
            @auth
                @php
                    $roleLabel = match(auth()->user()->role) {
                        'owner'    => 'propietario',
                        'employee' => 'empleado',
                        'client'   => 'cliente',
                        'admin'    => 'administrador',
                        default    => auth()->user()->role,
                    };
                @endphp

                @if (auth()->user()->role == 'owner')
                    <form action="{{ route('ownerRequests.leaveOwner') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1.5 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap">
                            Dejar de ser owner
                        </button>
                    </form>
                @endif

                <span class="text-xs text-violet-400 dark:text-violet-500 whitespace-nowrap">
                    {{ auth()->user()->name }}
                    <span class="text-violet-300 dark:text-violet-600">({{ $roleLabel }})</span>
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1.5 text-xs font-semibold bg-red-500 hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-600 text-white rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap cursor-pointer">
                        Cerrar sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="px-3 py-1.5 text-xs font-semibold bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="px-3 py-1.5 text-xs font-semibold bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap">
                    Registrarse
                </a>
            @endauth

            {{-- Toggle dark desktop --}}
            <button onclick="toggleDark()" id="dark-toggle"
                class="relative flex items-center w-14 h-7 rounded-full bg-violet-200 dark:bg-violet-700 transition-colors duration-300 cursor-pointer shrink-0"
                aria-label="Cambiar modo oscuro">
                <span id="toggle-thumb"
                    class="absolute left-1 w-5 h-5 rounded-full bg-white shadow-sm flex items-center justify-center transition-transform duration-300 dark:translate-x-7">
                    <svg id="icon-light" class="w-3 h-3 text-violet-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <svg id="icon-dark" class="w-3 h-3 text-violet-600 hidden" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </span>
            </button>
        </div>

        {{-- Botones móvil: dark toggle + hamburger --}}
        <div class="flex md:hidden items-center gap-2">
            {{-- Toggle dark móvil --}}
            <button onclick="toggleDark()" id="dark-toggle-mobile"
                class="relative flex items-center w-12 h-6 rounded-full bg-violet-200 dark:bg-violet-700 transition-colors duration-300 cursor-pointer shrink-0"
                aria-label="Cambiar modo oscuro">
                <span id="toggle-thumb-mobile"
                    class="absolute left-0.5 w-5 h-5 rounded-full bg-white shadow-sm flex items-center justify-center transition-transform duration-300 dark:translate-x-6">
                    <svg id="icon-light-mobile" class="w-3 h-3 text-violet-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <svg id="icon-dark-mobile" class="w-3 h-3 text-violet-600 hidden" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </span>
            </button>

            {{-- Hamburger --}}
            <button onclick="toggleMenu()" id="hamburger"
                class="p-2 rounded-lg text-violet-500 dark:text-violet-400 hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150"
                aria-label="Abrir menú">
                <svg id="icon-menu" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>

    {{-- Menú móvil colapsable --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-violet-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex flex-col gap-1">

            <a href="{{ route('businesses.index') }}"
                class="px-3 py-2 text-sm text-violet-700 dark:text-violet-300 font-medium rounded-lg hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                @auth
                    @if (auth()->user()->role == 'owner' || auth()->user()->role == 'employee')
                        Mis negocios
                    @else
                        Ver todos los negocios
                    @endif
                @else
                    Ver todos los negocios
                @endauth
            </a>

            @auth
                @php
                    $roleLabel = match(auth()->user()->role) {
                        'owner'    => 'Propietario',
                        'employee' => 'Empleado',
                        'client'   => 'Cliente',
                        'admin'    => 'Administrador',
                        default    => auth()->user()->role,
                    };
                @endphp

                @if (auth()->user()->role == 'client')
                    <a href="{{ route('appointments.myAppointments') }}"
                        class="px-3 py-2 text-sm text-violet-700 dark:text-violet-300 font-medium rounded-lg hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        Mis citas
                    </a>
                    <a href="{{ route('ownerRequests.plans') }}"
                        class="px-3 py-2 text-sm text-violet-700 dark:text-violet-300 font-medium rounded-lg hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        Hazte owner
                    </a>
                @endif

                @if (auth()->user()->role == 'owner')
                    <a href="{{ route('ownerRequests.plans') }}"
                        class="px-3 py-2 text-sm text-violet-700 dark:text-violet-300 font-medium rounded-lg hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        Actualizar plan
                    </a>
                    <a href="{{ route('businesses.create') }}"
                        class="px-3 py-2 text-sm text-violet-700 dark:text-violet-300 font-medium rounded-lg hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        Crear nuevo negocio
                    </a>
                @endif

                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('users.index') }}"
                        class="px-3 py-2 text-sm text-violet-700 dark:text-violet-300 font-medium rounded-lg hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        Usuarios
                    </a>
                @endif

                <div class="border-t border-violet-100 dark:border-gray-700 my-1"></div>

                <div class="px-3 py-2 text-xs text-violet-400 dark:text-violet-500">
                    {{ auth()->user()->name }}
                    <span class="text-violet-300 dark:text-violet-600">({{ $roleLabel }})</span>
                </div>

                @if (auth()->user()->role == 'owner')
                    <form action="{{ route('ownerRequests.leaveOwner') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full text-left px-3 py-2 text-sm font-semibold text-violet-700 dark:text-violet-300 rounded-lg hover:bg-violet-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            Dejar de ser owner
                        </button>
                    </form>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 text-sm font-semibold text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-red-950 transition-colors duration-150 cursor-pointer">
                        Cerrar sesión
                    </button>
                </form>
            @else
                <div class="border-t border-violet-100 dark:border-gray-700 my-1"></div>
                <a href="{{ route('login') }}"
                    class="mx-3 my-1 px-3 py-2 text-sm font-semibold text-center bg-violet-100 dark:bg-violet-900 hover:bg-violet-200 dark:hover:bg-violet-800 text-violet-700 dark:text-violet-300 rounded-lg transition-colors duration-150">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="mx-3 my-1 px-3 py-2 text-sm font-semibold text-center bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white rounded-lg transition-colors duration-150">
                    Registrarse
                </a>
            @endauth

        </div>
    </div>
</nav>

<script>
    const html = document.documentElement;

    const iconLight       = document.getElementById('icon-light');
    const iconDark        = document.getElementById('icon-dark');
    const iconLightMobile = document.getElementById('icon-light-mobile');
    const iconDarkMobile  = document.getElementById('icon-dark-mobile');

    function applyTheme(isDark) {
        isDark ? html.classList.add('dark') : html.classList.remove('dark');
        iconLight?.classList.toggle('hidden', isDark);
        iconDark?.classList.toggle('hidden', !isDark);
        iconLightMobile?.classList.toggle('hidden', isDark);
        iconDarkMobile?.classList.toggle('hidden', !isDark);
    }

    applyTheme(localStorage.getItem('theme') === 'dark');

    function toggleDark() {
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        iconLight?.classList.toggle('hidden', isDark);
        iconDark?.classList.toggle('hidden', !isDark);
        iconLightMobile?.classList.toggle('hidden', isDark);
        iconDarkMobile?.classList.toggle('hidden', !isDark);
    }

    function toggleMenu() {
        const menu      = document.getElementById('mobile-menu');
        const iconMenu  = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');
        const isOpen    = !menu.classList.contains('hidden');

        menu.classList.toggle('hidden', isOpen);
        iconMenu.classList.toggle('hidden', !isOpen);
        iconClose.classList.toggle('hidden', isOpen);
    }
</script>