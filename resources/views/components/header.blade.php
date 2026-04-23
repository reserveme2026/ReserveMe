<header>
    <h1>ReservMe</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('businesses.index') }}">Ver todos los negocios</a>
            </li>

            @auth
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'owner')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('businesses.create') }}">Crear nuevo negocio</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('services.index') }}">Ver todos los servicios</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('services.create') }}">Crear nuevo servicio</a>
                    </li>
                @endif

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('appointments.index') }}">Mis citas</a>
                </li>

                @if (auth()->user()->role == 'client' && auth()->user()->owner_request_status != 'pending')
                    <li class="nav-item active">
                        <form action="{{ route('users.requestOwner') }}" method="post" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">
                                Solicitar ser propietario
                            </button>
                        </form>
                    </li>
                @endif

                @if (auth()->user()->role == 'client' && auth()->user()->owner_request_status == 'pending')
                    <li class="nav-item active">
                        <span class="nav-link">Solicitud pendiente</span>
                    </li>
                @endif

                @if (auth()->user()->role == 'admin')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a>
                    </li>
                @endif

                <li class="nav-item active">
                    <span class="nav-link">
                        {{ auth()->user()->name }}
                    </span>
                </li>

                <li class="nav-item active">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
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
    </nav>
</header>
