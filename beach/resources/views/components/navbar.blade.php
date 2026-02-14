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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prenotazioni.create') }}">
                        <i class="bi bi-plus-square"></i> Aggiungi Prenotazione
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prenotazioni.partenze') }}">
                        <i class="bi bi-cpu"></i> Partenze
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-warning" href="{{ route('technology') }}">
                        <i class="bi bi-cpu"></i> Tecnologia: come funziona la nostra pagina ?
                    </a>
                </li>
            </ul>
            {{-- FORM DI RICERCA --}}
            <form class="d-flex ms-auto" action="{{ route('prenotazioni.index') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Cerca Nome, Cognome, Tel, Email..."
                    aria-label="Search" name="search" value="{{ request('search') }}" style="width: 300px;">
                <button class="btn btn-outline-light" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
</nav>