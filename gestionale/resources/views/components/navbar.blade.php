<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('welcome') }}" aria-current="page">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customers.create') }}">Aggiungi Cliente</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('rooms.todayDepartures') }}">
                Camere da Pulire
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customers.todayDeparturesBilling') }}">
                Gestione Conti
            </a>
        </li>
        {{-- Aggiungi qui il pulsante per la modalità notte --}}
        <li class="nav-item ms-3">
          <button id="night-mode-toggle" class="btn btn-dark">
            <i class="fas fa-moon"></i> Modalità Notte
          </button>
        </li>
      </ul>
      <form class="d-flex" role="search" method="GET" action="{{ route('customers.search') }}">
        <input class="form-control me-2" type="search" placeholder="Cerca cliente..." aria-label="Search" name="query"/>
        <button class="btn btn-outline-success" type="submit">Cerca</button>
      </form>
    </div>
  </div>
</nav>

{{-- Aggiungi questo link per l'icona della luna di Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">