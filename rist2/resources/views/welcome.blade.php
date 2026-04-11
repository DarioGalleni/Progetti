<x-layout>
    <!-- Hero Section -->
    <header id="home" class="parallax d-flex align-items-center justify-content-center text-center vh-100"
        style="background-image: url('{{ asset('imgs/header.avif') }}');">
        <div class="parallax-overlay"></div>
        <div class="container position-relative z-index-2 text-white">
            <h1 class="display-1 fw-bold mb-4 parallax-element fade-up">Sapori Autentici dell'Italia</h1>
            <p class="lead mb-5 fade-up delay-1 mx-auto" style="max-width: 600px;">
                Un'esperienza culinaria che celebra la tradizione italiana con ingredienti freschi e ricette di famiglia
            </p>
            <a href="#menu" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow fade-up delay-2">
                Esplora il Menu <i data-lucide="utensils" class="ms-2"></i>
            </a>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 fade-up">
                <h2 class="display-5 fw-bold text-primary">La Nostra Storia</h2>
                <div class="mx-auto border-bottom border-primary border-3 mt-3" style="width: 80px;"></div>
            </div>
            <div class="row align-items-center g-5 mt-3">
                <div class="col-lg-6 fade-up">
                    <div class="position-relative">
                        <img src="{{ asset('imgs/about.avif') }}" alt="Nostro Ristorante"
                            class="img-fluid rounded-4 shadow-lg about-img object-fit-cover w-100"
                            style="height: 500px;">
                        <div class="position-absolute bottom-0 end-0 bg-primary text-white p-4 rounded-4 shadow-lg text-center d-none d-md-block"
                            style="transform: translate(15%, 15%);">
                            <h3 class="fw-bold mb-0 display-4">25+</h3>
                            <p class="mb-0 fs-5">Anni di Gusto</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fade-up delay-1 ps-lg-5">
                    <h3 class="h2 fw-bold mb-4">Cucina Tradizionale con un Tocco Moderno</h3>
                    <p class="text-muted mb-4 fs-5" style="line-height: 1.8;">
                        Fondato nel 1995, Gusto&Trattoria è diventato un punto di riferimento per gli amanti della buona
                        cucina. La nostra passione per la gastronomia italiana si riflette in ogni piatto che serviamo.
                    </p>
                    <p class="text-muted mb-5" style="line-height: 1.8;">
                        Utilizziamo solo ingredienti freschi e di stagione, selezionati con cura dai nostri fornitori
                        locali. Le nostre ricette sono un omaggio alle tradizioni regionali italiane, rivisitate con
                        creatività e rispetto.
                    </p>
                    <div class="row g-4 text-center">
                        <div class="col-sm-4">
                            <div
                                class="p-3 bg-white rounded-3 shadow-sm border h-100 d-flex flex-column justify-content-center hover-up">
                                <h4 class="text-primary fw-bold mb-1 fs-2">25+</h4>
                                <span class="text-muted small fw-semibold">Anni di Esperienza</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div
                                class="p-3 bg-white rounded-3 shadow-sm border h-100 d-flex flex-column justify-content-center hover-up">
                                <h4 class="text-primary fw-bold mb-1 fs-2">10k+</h4>
                                <span class="text-muted small fw-semibold">Clienti Soddisfatti</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div
                                class="p-3 bg-white rounded-3 shadow-sm border h-100 d-flex flex-column justify-content-center hover-up">
                                <h4 class="text-primary fw-bold mb-1 fs-2">50+</h4>
                                <span class="text-muted small fw-semibold">Piatti Unici</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Parallax Divider -->
    <section class="parallax py-5" style="background-image: url('{{ asset('imgs/divider.avif') }}'); height: 350px;">
        <div class="parallax-overlay" style="background: rgba(0, 0, 0, 0.45);"></div>
        <div class="container h-100 position-relative z-index-2 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold font-playfair display-4 text-center shadow-text">"Il buon cibo è il fondamento
                della vera felicità."</h2>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-5 bg-white position-relative">
        <div class="container py-5">
            <div class="text-center mb-5 fade-up">
                <h2 class="display-5 fw-bold text-primary">Il Nostro Menu</h2>
                <p class="text-muted fs-5 mt-2">Ispirato alla tradizione, servito con passione</p>
                <div class="mx-auto border-bottom border-primary border-3 mt-3" style="width: 80px;"></div>
            </div>

            <div class="row g-4 justify-content-center mt-4">
                <!-- Antipasti -->
                <div class="col-md-6 col-lg-3 fade-up">
                    <div class="card border-0 shadow-sm h-100 menu-card rounded-4 overflow-hidden">
                        <div class="position-relative menu-img-wrapper">
                            <img src="{{ asset('imgs/1.avif') }}" alt="Antipasto"
                                class="card-img-top object-fit-cover w-100 h-100">
                            <span
                                class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 shadow-sm rounded-pill">Antipasti</span>
                        </div>
                        <div class="card-body d-flex flex-column p-4 bg-white z-index-2">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="card-title fw-bold mb-0 text-dark">Bruschette Miste</h4>
                                <span class="text-primary fw-bold fs-5 px-3 py-1 bg-light rounded-pill">€8</span>
                            </div>
                            <p class="card-text text-muted flex-grow-1">Tre gusti diversi di bruschetta: pomodoro
                                fresco, porcini e olive per iniziare bene.</p>
                        </div>
                    </div>
                </div>

                <!-- Primi -->
                <div class="col-md-6 col-lg-3 fade-up delay-1">
                    <div class="card border-0 shadow-sm h-100 menu-card rounded-4 overflow-hidden">
                        <div class="position-relative menu-img-wrapper">
                            <img src="{{ asset('imgs/2.avif') }}" alt="Primo"
                                class="card-img-top object-fit-cover w-100 h-100">
                            <span
                                class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 shadow-sm rounded-pill">Primi</span>
                        </div>
                        <div class="card-body d-flex flex-column p-4 bg-white z-index-2">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="card-title fw-bold mb-0 text-dark">Spaghetti Carbonara</h4>
                                <span class="text-primary fw-bold fs-5 px-3 py-1 bg-light rounded-pill">€14</span>
                            </div>
                            <p class="card-text text-muted flex-grow-1">Ricetta tradizionale romana con guanciale
                                croccante, uova fresche e pecorino DOP.</p>
                        </div>
                    </div>
                </div>

                <!-- Secondi -->
                <div class="col-md-6 col-lg-3 fade-up delay-2">
                    <div class="card border-0 shadow-sm h-100 menu-card rounded-4 overflow-hidden">
                        <div class="position-relative menu-img-wrapper">
                            <img src="{{ asset('imgs/3.avif') }}" alt="Secondo"
                                class="card-img-top object-fit-cover w-100 h-100">
                            <span
                                class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 shadow-sm rounded-pill">Secondi</span>
                        </div>
                        <div class="card-body d-flex flex-column p-4 bg-white z-index-2">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="card-title fw-bold mb-0 text-dark">Osso Buco Milanese</h4>
                                <span class="text-primary fw-bold fs-5 px-3 py-1 bg-light rounded-pill">€18</span>
                            </div>
                            <p class="card-text text-muted flex-grow-1">Tenero taglio di vitello accompagnato con il
                                nostro iconico risotto allo zafferano.</p>
                        </div>
                    </div>
                </div>

                <!-- Dolci -->
                <div class="col-md-6 col-lg-3 fade-up delay-3">
                    <div class="card border-0 shadow-sm h-100 menu-card rounded-4 overflow-hidden">
                        <div class="position-relative menu-img-wrapper">
                            <img src="{{ asset('imgs/4.avif') }}" alt="Dolce"
                                class="card-img-top object-fit-cover w-100 h-100">
                            <span
                                class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 shadow-sm rounded-pill">Dolci</span>
                        </div>
                        <div class="card-body d-flex flex-column p-4 bg-white z-index-2">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="card-title fw-bold mb-0 text-dark">Tiramisù Classico</h4>
                                <span class="text-primary fw-bold fs-5 px-3 py-1 bg-light rounded-pill">€7</span>
                            </div>
                            <p class="card-text text-muted flex-grow-1">Il classico e intramontabile dolce italiano al
                                cucchiaio, preparato fresco ogni giorno.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 pt-3 fade-up">
                <a href="#reservation" class="btn btn-outline-primary btn-lg rounded-pill px-5 py-3 shadow-sm hover-up">
                    Prenota un Tavolo <i data-lucide="calendar-days" class="ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-5 bg-light border-top">
        <div class="container-fluid px-0 pt-5">
            <div class="text-center mb-5 fade-up">
                <h2 class="display-5 fw-bold text-primary">I Nostri Ambienti</h2>
                <div class="mx-auto border-bottom border-primary border-3 mt-3" style="width: 80px;"></div>
            </div>

            <div class="row g-0">
                <div class="col-6 col-md-3 overflow-hidden gallery-img position-relative group">
                    <img src="{{ asset('imgs/gallery.avif') }}" alt="Ristorante"
                        class="w-100 h-100 object-fit-cover transition-transform">
                    <div class="gallery-overlay d-flex align-items-center justify-content-center">
                        <i data-lucide="zoom-in" class="text-white fs-1"></i>
                    </div>
                </div>
                <div class="col-6 col-md-3 overflow-hidden gallery-img position-relative group">
                    <img src="{{ asset('imgs/gallery_2.avif') }}" alt="Interni"
                        class="w-100 h-100 object-fit-cover transition-transform">
                    <div class="gallery-overlay d-flex align-items-center justify-content-center">
                        <i data-lucide="zoom-in" class="text-white fs-1"></i>
                    </div>
                </div>
                <div class="col-6 col-md-3 overflow-hidden gallery-img position-relative group">
                    <img src="{{ asset('imgs/gallery_3.avif') }}" alt="Cucina"
                        class="w-100 h-100 object-fit-cover transition-transform">
                    <div class="gallery-overlay d-flex align-items-center justify-content-center">
                        <i data-lucide="zoom-in" class="text-white fs-1"></i>
                    </div>
                </div>
                <div class="col-6 col-md-3 overflow-hidden gallery-img position-relative group">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&q=80&w=600"
                        alt="Piatti" class="w-100 h-100 object-fit-cover transition-transform">
                    <div class="gallery-overlay d-flex align-items-center justify-content-center">
                        <i data-lucide="zoom-in" class="text-white fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reservation Section -->
    <section id="reservation" class="parallax py-5"
        style="background-image: url('{{ asset('imgs/reservation.avif') }}');">
        <div class="parallax-overlay" style="background: rgba(0, 0, 0, 0.75);"></div>
        <div class="container py-5 position-relative z-index-2">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7 fade-up">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4 pb-2">
                                <h2 class="display-6 fw-bold text-primary mb-3">Prenota Ora</h2>
                                <p class="text-muted">Assicurati il tuo tavolo per un'esperienza indimenticabile.</p>
                            </div>

                            <form action="{{ route('reservations.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6 form-floating">
                                        <input type="text" class="form-control bg-light border-0" id="name" name="name"
                                            placeholder="Il tuo nome" required>
                                        <label for="name" class="ps-4">Nome e Cognome</label>
                                    </div>
                                    <div class="col-md-6 form-floating">
                                        <input type="number" class="form-control bg-light border-0" id="phone"
                                            name="phone" placeholder="Il tuo numero" required>
                                        <label for="phone" class="ps-4">Telefono</label>
                                    </div>
                                    <div class="col-md-4 form-floating">
                                        <input type="date" class="form-control bg-light border-0" id="date" name="date"
                                            required>
                                        <label for="date" class="ps-4">Data</label>
                                    </div>
                                    <div class="col-md-4 form-floating">
                                        <select class="form-select bg-light border-0" id="time" name="time"
                                            aria-label="Orario" required>
                                            <option value="" selected disabled>Scegli l'orario</option>
                                            <optgroup label="Pranzo">
                                                <option value="12:00">12:00</option>
                                                <option value="12:15">12:15</option>
                                                <option value="12:30">12:30</option>
                                                <option value="12:45">12:45</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:15">13:15</option>
                                                <option value="13:30">13:30</option>
                                            </optgroup>
                                            <optgroup label="Cena">
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                            </optgroup>
                                        </select>
                                        <label for="time" class="ps-4">Orario</label>
                                    </div>
                                    <div class="col-md-4 form-floating">
                                        <select class="form-select bg-light border-0" id="guests" name="guests"
                                            aria-label="Persone" required>
                                            <option value="" selected disabled>Ospiti</option>
                                            <option value="1">1 Persona</option>
                                            <option value="2">2 Persone</option>
                                            <option value="3">3 Persone</option>
                                            <option value="4">4 Persone</option>
                                            <option value="5">5 Persone</option>
                                            <option value="6+">6+ Persone</option>
                                        </select>
                                        <label for="guests" class="ps-4">Ospiti</label>
                                    </div>
                                    <div class="col-12 form-floating">
                                        <textarea class="form-control bg-light border-0" id="message" name="message"
                                            style="height: 120px" placeholder="Note Speciali..."></textarea>
                                        <label for="message" class="ps-4">Intolleranze o richieste
                                            speciali...</label>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg rounded-pill px-5 py-3 w-100 shadow fw-bold hover-up">
                                            Conferma Tavolo <i data-lucide="check-circle" class="ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Footer Section -->
    <footer id="contact" class="bg-dark text-white pt-5">
        <div class="container pt-4 pb-2 fade-up">
            <div class="row g-5 mb-5">
                <div class="col-lg-4 pe-lg-5">
                    <h3 class="text-primary fw-bold mb-4 font-playfair fs-2">Gusto&Trattoria</h3>
                    <p class="text-white-50 mb-4 lh-lg">Un'esperienza culinaria che celebra la tradizione italiana con
                        ingredienti freschi e ricette di famiglia per regalarti emozioni autentiche ad ogni boccone.</p>
                </div>

                <div class="col-lg-4">
                    <h4 class="h5 fw-bold mb-4 text-white">Contatti Diretti</h4>
                    <ul class="list-unstyled text-white-50 lh-lg">
                        <li class="d-flex mb-3 align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 mt-1 text-primary">
                                <i data-lucide="map-pin" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <span class="d-block text-white">Indirizzo</span>
                                Via Del Gusto 15, 00187 Roma
                            </div>
                        </li>
                        <li class="d-flex mb-3 align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 mt-1 text-primary">
                                <i data-lucide="phone" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <span class="d-block text-white">Telefono</span>
                                +39 06 1234567
                            </div>
                        </li>
                        <li class="d-flex mb-3 align-items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 mt-1 text-primary">
                                <i data-lucide="mail" style="width: 20px; height: 20px;"></i>
                            </div>
                            <div>
                                <span class="d-block text-white">Email</span>
                                info@gustoetrattoria.it
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h4 class="h5 fw-bold mb-4 text-white">Orari di Servizio</h4>
                    <div class="bg-white bg-opacity-10 rounded-4 p-4">
                        <ul class="list-unstyled text-white-50 mb-0">
                            <li
                                class="d-flex justify-content-between border-bottom border-light border-opacity-10 pb-3 mb-3">
                                <span class="text-white">Feriali</span>
                                <span>12:00 - 23:30</span>
                            </li>
                            <li
                                class="d-flex justify-content-between border-bottom border-light border-opacity-10 pb-3 mb-3">
                                <span class="text-white">Sabato</span>
                                <span>12:00 - 00:00</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span class="text-white text-danger">Domenica</span>
                                <span>Chiuso</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr class="border-secondary m-0">

            <div class="text-center text-white-50 py-4 small">
                &copy; {{ date('Y') }} Gusto&Trattoria. Tutti i diritti riservati.<br>Fatto con <i data-lucide="heart"
                    class="text-danger d-inline mx-1" style="width:14px;"></i> passione.
            </div>
        </div>
    </footer>

    @if(session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-0 pb-0 justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pb-5 px-5">
                        <div class="mb-4 text-success d-flex justify-content-center">
                            <i data-lucide="check-circle" style="width: 80px; height: 80px;"></i>
                        </div>
                        <h3 class="fw-bold mb-3" id="successModalLabel">Prenotazione Confermata!</h3>
                        <p class="mt-4 text-secondary">Puoi visualizzare o cancellare la tua prenotazione usando il bottone
                            <b>Cerca Prenotazione</b> nella barra in alto, inserendo il tuo numero di telefono e il nome
                            associato.
                        </p>
                        <button type="button" class="btn btn-primary rounded-pill px-5 mt-4"
                            data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="module">
            // Uso type="module" così attende il caricamento di Vite (e quindi app.js)
            setTimeout(() => {
                if (window.bootstrap) {
                    var successModal = new window.bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                }
            }, 100);
        </script>
    @endif

    @if(session('error'))
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-0 pb-0 justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pb-5 px-5">
                        <div class="mb-4 text-danger d-flex justify-content-center">
                            <i data-lucide="x-circle" style="width: 80px; height: 80px;"></i>
                        </div>
                        <h3 class="fw-bold mb-3" id="errorModalLabel">Spiacenti</h3>
                        <p class="text-muted fs-5">{{ session('error') }}</p>
                        <button type="button" class="btn btn-secondary rounded-pill px-5 mt-4"
                            data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="module">
            setTimeout(() => {
                if (window.bootstrap) {
                    var errorModal = new window.bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                }
            }, 100);
        </script>
    @endif
</x-layout>