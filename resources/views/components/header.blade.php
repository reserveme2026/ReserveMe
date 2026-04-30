<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('businesses.index') }}">ReservMe</a>

        <ul class="navbar-nav me-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('businesses.index') }}">
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
            </li>

            @auth
            @if (auth()->user()->role == 'client')
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('appointments.myAppointments') }}">
                    Mis citas
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'owner')
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('businesses.create') }}">
                    Crear nuevo negocio
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'admin')
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('users.index') }}">
                    Usuarios
                </a>
            </li>
            @endif
            @endauth
            @auth
            @if (auth()->user()->role == 'client' && auth()->user()->owner_request_status != 'pending')
            <li class="nav-item active me-2">
                <form action="{{ route('users.requestOwner') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm">
                        Solicitar ser owner
                    </button>
                </form>
            </li>
            @endif

            <li class="nav-item active me-2">
                <span class="nav-link">
                    {{ auth()->user()->name }} ({{ auth()->user()->role }})
                </span>
            </li>

            <li class="nav-item active">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Cerrar sesión
                    </button>
                </form>
            </li>
            @else
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
            </li>
            @endauth
        </ul>
    </div>
</nav>