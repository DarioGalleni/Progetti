<nav class="navbar navbar-expand-lg navbar-dark sticky-top" aria-label="Menu di navigazione principale">
        <div class="container">
            <a class="navbar-brand" href="/" aria-label="Vai alla pagina iniziale">
                <i class="fas fa-sun me-2"></i>Sunset Travel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Espandi il menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" aria-label="Vai alla sezione Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinations.index') }}" aria-label="Vai alla sezione Destinazioni">Destinazioni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinations.create') }}" aria-label="Vai alla sezione Aggiungi Destinazione">Aggiungi Destinazione</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" aria-label="Vai alla sezione Chi Siamo">Chi Siamo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials" aria-label="Vai alla sezione Recensioni">Recensioni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact" aria-label="Vai alla sezione Contatti">Contatti</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>