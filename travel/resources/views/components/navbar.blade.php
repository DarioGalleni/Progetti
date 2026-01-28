<nav class="navbar navbar-expand-lg navbar-dark {{ Request::routeIs('home') ? 'bg-transparent' : 'bg-dark' }} fixed-top transition-all duration-300" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-uppercase" href="{{ route('home') }}">
            Start<span class="text-primary">Journey</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link fs-5 mx-2 {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mx-2 {{ Request::routeIs('journeys.index') ? 'active' : '' }}" href="{{ route('journeys.index') }}">Viaggi</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-primary rounded-pill px-4 fs-6 fw-bold shadow-sm {{ Request::routeIs(['journeys.table', 'journeys.create', 'journeys.edit']) ? 'active' : '' }}" href="{{ route('journeys.table') }}">
                        <i class="bi bi-gear-fill me-1"></i> Gestisci
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>