<nav
    class="bg-white dark:bg-gray-800 border-b border-violet-100 dark:border-gray-700 shadow-sm mb-6 transition-colors duration-200">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center gap-6">

        <a href="{{ route('businesses.index') }}"
            class="text-xl font-bold text-violet-700 dark:text-violet-400 hover:text-violet-900 dark:hover:text-violet-300 transition-colors duration-150 shrink-0">
            ReservMe
        </a>

        <div class="flex items-center gap-4 flex-1">
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
                @endif

                @if (auth()->user()->role == 'owner')
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

        <div class="flex items-center gap-2 shrink-0">
            @auth
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
                    <span class="text-violet-300 dark:text-violet-600">({{ auth()->user()->role }})</span>
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
                    class="text-sm text-violet-500 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-medium transition-colors duration-150 whitespace-nowrap">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}"
                    class="px-3 py-1.5 text-xs font-semibold bg-purple-500 hover:bg-purple-600 dark:bg-purple-700 dark:hover:bg-purple-600 text-white rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap">
                    Registrarse
                </a>
            @endauth

            <button onclick="toggleDark()" id="dark-toggle"
                class="relative flex items-center w-14 h-7 rounded-full bg-violet-200 dark:bg-violet-700 transition-colors duration-300 cursor-pointer shrink-0"
                aria-label="Cambiar modo oscuro">

                {{-- Círculo deslizante --}}
                <span id="toggle-thumb"
                    class="absolute left-1 w-5 h-5 rounded-full bg-white shadow-sm flex items-center justify-center transition-transform duration-300 dark:translate-x-7">

                    {{-- Sol (visible en modo claro) --}}
                    <svg id="icon-light" class="w-3 h-3 text-violet-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>

                    {{-- Luna (visible en modo oscuro) --}}
                    <svg id="icon-dark" class="w-3 h-3 text-violet-600 hidden" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>

                </span>
            </button>
        </div>

    </div>
</nav>

<script>
    const html = document.documentElement;
    const iconLight = document.getElementById('icon-light');
    const iconDark = document.getElementById('icon-dark');

    function applyTheme(isDark) {
        isDark ? html.classList.add('dark') : html.classList.remove('dark');
        iconLight.classList.toggle('hidden', isDark);
        iconDark.classList.toggle('hidden', !isDark);
    }

    // Aplica al cargar
    applyTheme(localStorage.getItem('theme') === 'dark');

    function toggleDark() {
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        iconLight.classList.toggle('hidden', isDark);
        iconDark.classList.toggle('hidden', !isDark);
    }
</script>