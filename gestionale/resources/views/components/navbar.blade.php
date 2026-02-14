<nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm" style="z-index: 1050;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            <i class="bi bi-building"></i> Gemma Hotel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-bold' : '' }}"
                        href="{{ url('/') }}">Calendario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customers/create') ? 'active fw-bold' : '' }}"
                        href="{{ url('/customers/create') }}">Nuova Prenotazione</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('groups.create') ? 'active fw-bold' : '' }}"
                        href="{{ route('groups.create') }}">Nuovo Gruppo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('restaurant.index') ? 'active fw-bold' : '' }}"
                        href="{{ route('restaurant.index') }}">Ristorante</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cleaning.index') ? 'active fw-bold' : '' }}"
                        href="{{ route('cleaning.index') }}">Pulizie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('arrivals.index') ? 'active fw-bold' : '' }}"
                        href="{{ route('arrivals.index') }}">Arrivi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('departures.index') ? 'active fw-bold' : '' }}"
                        href="{{ route('departures.index') }}">Partenze</a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link fw-bold text-danger {{ request()->routeIs('documentation') ? 'active' : '' }}"
                        href="{{ route('documentation') }}">Documentazione</a>
                </li>
            </ul>
            <form class="d-flex align-items-center" role="search" action="{{ route('customers.index') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Cerca ospite..." aria-label="Search"
                    name="q" value="{{ request('q') }}">
                <button class="btn btn-outline-primary" type="submit">Cerca</button>
            </form>
            <div class="dropdown ms-lg-2 mt-2 mt-lg-0">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-gear-fill"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="d-none d-md-block">
                        <form class="d-none d-md-block" action="{{ route('system.backup-db') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-success" type="submit">
                                <i class="bi bi-database-down me-2 text-success"></i> Backup
                            </button>
                        </form>
                    </li>
                    <li class="d-none d-md-block">
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('system.clear-cache') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="bi bi-hdd-network me-2"></i> Pulisci Cache
                            </button>
                        </form>
                </ul>
            </div>
        </div>
    </div>
</nav>