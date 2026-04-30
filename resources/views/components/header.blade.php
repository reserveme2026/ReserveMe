<nav class="bg-white shadow-md mb-6">
    <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('businesses.index') }}"
            class="text-xl font-bold text-blue-600 hover:text-blue-700 transition">
            ReservMe
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('businesses.index') }}"
                class="text-sm text-gray-600 hover:text-blue-600 transition">
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
                        class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Mis citas
                    </a>
                @endif

                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'owner')
                    <a href="{{ route('businesses.create') }}"
                        class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Crear nuevo negocio
                    </a>
                @endif

                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('users.index') }}"
                        class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Usuarios
                    </a>
                @endif
            @endauth
        </div>

        <div class="flex items-center gap-3">
            @auth
                @if (auth()->user()->role == 'client' && auth()->user()->owner_request_status != 'pending')
                    <form action="{{ route('users.requestOwner') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1.5 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg transition">
                            Solicitar ser owner
                        </button>
                    </form>
                @endif

                <span class="text-sm text-gray-500">
                    {{ auth()->user()->name }}
                    <span class="text-xs text-gray-400">({{ auth()->user()->role }})</span>
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1.5 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                        Cerrar sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm text-gray-600 hover:text-blue-600 transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="px-3 py-1.5 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                    Registrarse
                </a>
            @endauth
        </div>

    </div>
</nav>