<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm hidden-navbar">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center fw-semibold text-decoration-none" href="#">
            <i class="fas fa-utensils text-warning fs-5"></i>
            <span class="brand-text ms-2 d-inline-block">Ristorante Buongusto</span>
        </a>

        <div class="collapse navbar-collapse flex-grow-1" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Chi Siamo</a></li>
                <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contatti</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Solo per Admin" href="{{ route('reservations.index') }}">Prenotazioni</a></li>
                <li class="nav-item"><a class="btn btn-primary" href="{{ route('reservations.find') }}">Modifica Prenotazione</a></li>
            </ul>
        </div>

        <button class="navbar-toggler ms-auto order-last" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>