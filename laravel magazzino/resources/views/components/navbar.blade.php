<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{-- Brand dell'applicazione --}}
        <a class="navbar-brand" href="{{ route('welcome') }}">Laravel App</a>

        {{-- Toggler per mobile (per menu a scomparsa) --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                @if (Auth::user()->is_admin)
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('createUsers') }}">Crea Utente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('allUsers') }}">Tutti gli utenti</a>
                        </li>
                    </ul>
                @endif
            @endauth
                    <ul class="navbar-nav ms-auto">
                @guest {{-- ospite--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
                @auth {{-- auth --}}
                    <li class="nav-item">
                        <span class="nav-link">Benvenuto, {{ Auth::user()->username }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" id="logout">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>