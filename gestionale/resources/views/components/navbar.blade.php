<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active btn btn-primary" href="{{ route('welcome') }}" aria-current="page">Calendario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('groups.create') }}">Aggiungi Gruppo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customers.create') }}">Aggiungi Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('rooms.todayDepartures') }}">
            Pulizia Camere
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customers.restaurant') }}">
            Ristorante
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customers.todayDeparturesBilling') }}">
            Partenze
          </a>
        </li>
        <li class="nav-item ms-2">
          <button id="enable-night-mode" class="btn btn-dark" title="Attiva modalità notte">
            <span class="theme-icon"><i class="fas fa-moon"></i></span>
          </button>
          <button id="disable-night-mode" class="btn btn-sun hidden" title="Disattiva modalità notte">
            <span class="theme-icon"><i class="fas fa-sun"></i></span>
          </button>
        </li>
        <li class="nav-item ms-2">
          <form method="POST" action="{{ route('optimize.clear') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary" title="Clear cache e file ottimizzati">
              <i class="fas fa-broom"></i>
            </button>
          </form>
        </li>
      </ul>
      <form class="d-flex" role="search" method="GET" action="{{ route('customers.search') }}">
        <input class="form-control me-2" type="search" placeholder=" " aria-label="Search" name="query" />
        <button class="btn btn-outline-success" type="submit">Cerca</button>
      </form>
    </div>
  </div>
</nav>