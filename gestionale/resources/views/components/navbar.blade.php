<nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm">
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
            </ul>
            <form class="d-flex" role="search" action="{{ route('customers.index') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Cerca ospite..." aria-label="Search"
                    name="q" value="{{ request('q') }}">
                <button class="btn btn-outline-primary" type="submit">Cerca</button>
            </form>
            <div class="dropdown ms-2">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="utilityDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-gear-fill"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="utilityDropdown">
                    {{-- Sincronizzazione DB (Solo su PC) --}}
                    <li class="d-none d-lg-block">
                        <form action="{{ route('system.sync-db') }}" method="POST"
                            onsubmit="return confirm('⚠️ ATTENZIONE: Stai per sovrascrivere il database LOCALE con i dati ONLINE.\n\nTutti i dati locali verranno persi irrevocabilmente.\nSei sicuro di voler procedere?');">
                            @csrf
                            <button class="dropdown-item text-warning" type="submit" title="Copia da Online a Locale">
                                <i class="bi bi-arrow-repeat"></i> Sincronizza DB
                            </button>
                        </form>
                    </li>
                    <li class="d-none d-lg-block"><hr class="dropdown-divider"></li>

                    {{-- Pulisci Cache --}}
                    <li>
                        <form action="{{ route('system.clear-cache') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="bi bi-hdd-network"></i> Pulisci Cache
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>