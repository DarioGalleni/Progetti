<nav class="navbar navbar-expand-lg navbar-dark {{ Request::routeIs('home') ? 'bg-transparent' : 'bg-dark' }} fixed-top transition-all duration-300"
    id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-uppercase" href="{{ route('home') }}">
            Start<span class="text-primary">Journey</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fs-5 mx-2 {{ Request::routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mx-2 {{ Request::routeIs('journeys.index') ? 'active' : '' }}"
                        href="{{ route('journeys.index') }}">Viaggi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 mx-2 {{ Request::routeIs('journeys.create') ? 'active' : '' }}"
                        href="{{ route('journeys.create') }}">Nuovo</a>
                </li>
            </ul>
        </div>
    </div>
</nav>