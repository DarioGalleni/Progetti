<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-umbrella-fill"></i> Gestionale Ombrelloni
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                        <i class="bi bi-graph-up"></i> Aggiungi Prenotazione
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i> Impostazioni
                    </a>
                </li>

                {{-- IL BLOCCO PER IL CAMBIO TEMA (MODALITÀ NOTTE) È STATO RIMOSSO DA QUI --}}
                
            </ul>
        </div>
    </div>
</nav>