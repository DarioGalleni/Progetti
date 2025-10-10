    <nav class="navbar navbar-expand-lg navbar-dark sticky-nav py-3">
        <div class="container">
            <a class="navbar-brand" href="#">Wanderlust Wizards ✨</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinations.index') }}">Destinazioni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Servizi</a>
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