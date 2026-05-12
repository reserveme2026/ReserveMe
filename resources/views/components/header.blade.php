<nav class="bg-white border-b border-violet-100 shadow-sm mb-6">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center gap-6">

        {{-- Logo --}}
        <a href="{{ route('businesses.index') }}"
            class="text-xl font-bold text-violet-700 hover:text-violet-900 transition-colors duration-150 shrink-0">
            ReservMe
        </a>

        {{-- Nav links --}}
        <div class="flex items-center gap-4 flex-1">
            <a href="{{ route('businesses.index') }}"
                class="text-sm text-violet-500 hover:text-violet-700 font-medium transition-colors duration-150 whitespace-nowrap">
                @auth
                    @if (auth()->user()->role == 'owner')
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
                        class="text-sm text-violet-500 hover:text-violet-700 font-medium transition-colors duration-150 whitespace-nowrap">
                        Mis citas
                    </a>
                @endif

                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'owner')
                    <a href="{{ route('businesses.create') }}"
                        class="text-sm text-violet-500 hover:text-violet-700 font-medium transition-colors duration-150 whitespace-nowrap">
                        Crear nuevo negocio
                    </a>
                @endif

                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('users.index') }}"
                        class="text-sm text-violet-500 hover:text-violet-700 font-medium transition-colors duration-150 whitespace-nowrap">
                        Usuarios
                    </a>
                @endif
            @endauth
        </div>

        {{-- User actions --}}
        <div class="flex items-center gap-2 shrink-0">
            @auth
                @if (auth()->user()->role == 'client' && auth()->user()->owner_request_status != 'pending')
                    <form action="{{ route('users.requestOwner') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1.5 text-xs font-semibold bg-amber-400 hover:bg-amber-500 text-white rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap">
                            Solicitar ser owner
                        </button>
                    </form>
                @endif

                <span class="text-xs text-violet-400 whitespace-nowrap">
                    {{ auth()->user()->name }}
                    <span class="text-violet-300">({{ auth()->user()->role }})</span>
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1.5 text-xs font-semibold bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap">
                        Cerrar sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm text-violet-500 hover:text-violet-700 font-medium transition-colors duration-150 whitespace-nowrap">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="px-3 py-1.5 text-xs font-semibold bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors duration-150 shadow-sm whitespace-nowrap">
                    Registrarse
                </a>
            @endauth
        </div>

    </div>
</nav>