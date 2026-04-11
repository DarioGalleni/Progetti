<nav class="navbar navbar-expand-lg navbar-dark fixed-top transition-all" id="mainNav">
    <div class="container py-2">
        <a class="navbar-brand font-playfair fs-3 fw-bold text-white mb-0" href="{{ url('/#home') }}"
            style="letter-spacing: 1px;">
            Gusto<span class="text-primary">&</span>Trattoria
        </a>
        <button class="navbar-toggler border-0 shadow-none focus-ring focus-ring-primary" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-2 gap-lg-3 text-center mt-3 mt-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-semibold" href="{{ url('/#home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-semibold" href="{{ url('/#about') }}">La Storia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-semibold" href="{{ url('/#menu') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-semibold" href="{{ url('/#gallery') }}">Galleria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-semibold" href="{{ url('/#contact') }}">Contatti</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <button type="button"
                        class="btn btn-outline-light rounded-pill px-3 py-1 d-flex align-items-center gap-2"
                        style="font-size: 0.85rem; border-color: rgba(255,255,255,0.3);" data-bs-toggle="modal"
                        data-bs-target="#searchReservationModal">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i> Cerca La Tua Prenotazione
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .placeholder-light::placeholder {
        color: rgba(255, 255, 255, 0.7) !important;
    }
</style>