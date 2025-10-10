<nav class="navbar navbar-expand-lg navbar-dark sticky-nav py-3">
    <div class="container">
        <a class="navbar-brand" href="#">Wanderlust Wizards ✨</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    {{-- Usa @if per applicare la classe 'active' solo sulla home --}}
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinations.index') }}">Destinazioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Solo per admin" href="{{ route('destinations.create') }}">Aggiungi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Recensioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contatti</a>
                </li>
            </ul>
            <button class="btn btn-secondary ms-3">Prenota Ora</button>
        </div>
    </div>
</nav>

{{-- Rimosso lo script inline per l'inizializzazione dei tooltip; ora è gestito in resources/js/bootstrap.js --}}