<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-umbrella-beach me-2"></i><span>BEACH CLUB</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home me-1"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prenotazioni.create') }}"><i
                            class="fas fa-plus-circle me-1"></i> Nuova Prenotazione</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prenotazioni.partenze') }}"><i
                            class="fas fa-suitcase-rolling me-1"></i> Partenze</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-warning" href="{{ route('technology') }}"><i
                            class="fas fa-microchip me-1"></i> Tecnologia</a>
                </li>
            </ul>
            <form class="d-flex ms-auto" action="{{ route('prenotazioni.index') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Cerca..." name="search"
                    value="{{ request('search') }}" style="width: 250px;">
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>