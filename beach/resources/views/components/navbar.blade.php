<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-umbrella-fill"></i>
            <span class="ms-1">Gestionale Ombrelloni</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                {{-- @auth --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prenotazioni.index') }}">
                        <i class="bi bi-calendar-check"></i> Prenotazioni
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prenotazioni.create') }}">
                        <i class="bi bi-plus-square"></i> Aggiungi Prenotazione
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('technology') }}">
                        <i class="bi bi-cpu"></i> Tecnologia
                    </a>
                </li>
                {{-- @endauth --}}
            </ul>
            {{-- FORM DI RICERCA --}}
            <form class="d-flex ms-auto" action="{{ route('prenotazioni.index') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Cerca Nome, Tel, Email..."
                    aria-label="Search" name="search" value="{{ request('search') }}" style="width: 250px;">
                <button class="btn btn-outline-light" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            {{-- FINE FORM DI RICERCA --}}

            {{-- BLOCCO LOGIN/UTENTE --}}
            {{-- <ul class="navbar-nav ms-2">
                @auth
                <li class="nav-item d-flex align-items-center me-3">
                    <span class="navbar-text text-white">
                        <i class="fas fa-user-circle me-1"></i>
                        <span id="saluto-dinamico"></span>, <strong>{{ auth()->user()->name }}</strong>
                    </span>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('register') }}" class="btn btn-sm btn-success disabled" aria-disabled="true"
                        tabindex="-1">
                        <i class="fas fa-user-plus me-1"></i>Registra Utente
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger disabled" aria-disabled="true" disabled
                            tabindex="-1">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                </li>
                @endauth
            </ul> --}}
            {{-- FINE BLOCCO LOGIN/UTENTE --}}
        </div>
    </div>
</nav>