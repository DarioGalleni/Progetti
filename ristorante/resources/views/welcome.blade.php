<x-layout>
    <section id="home" class="hero-section parallax-section" style="background-image: url('{{ route('restaurant.image', ['filename' => 'home-section.jpg']) }}');">
        <div class="overlay"></div>
        <div class="container content-wrapper text-center text-white position-relative">
            <div class="animate-float position-absolute top-0 start-50 translate-middle-x hero-crown-icon">
                <i class="fas fa-crown text-gold fa-2x"></i>
            </div>

            <span class="d-block mb-3 text-uppercase letter-spacing-2 text-gold fw-bold" data-aos="fade-down">
                Benvenuti al Buongusto
            </span>
            <h1 class="hero-title display-1 mb-4" data-aos="zoom-in" data-aos-delay="100">
                L'Eccellenza <br> <span class="serif-font fst-italic text-gold">Culinaria</span>
            </h1>
            <p class="hero-subtitle mb-5 mx-auto hero-subtitle-container" data-aos="fade-up" data-aos-delay="200">
                Un viaggio sensoriale attraverso i sapori autentici della tradizione italiana, rivisitati con eleganza moderna.
            </p>

            <div class="d-flex justify-content-center gap-3" data-aos="fade-up" data-aos-delay="300">
                <a href="#reservation" class="btn btn-primary-custom">
                    Prenota un Tavolo
                </a>
                <a href="#menu" class="btn btn-outline-light px-4 py-3 rounded-pill text-uppercase fw-bold btn-outline-scopri">
                    Scopri il Menu
                </a>
            </div>
        </div>
    </section>

    <section id="about" class="py-5 position-relative bg-dark">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="position-relative">
                        <div class="video-container">
                            <video class="w-100 d-block about-video" autoplay muted loop playsinline>
                                <source src="{{ route('restaurant.image', ['filename' => 'video.mp4']) }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="glass-card position-absolute bottom-0 end-0 m-4 p-3 text-center about-badge">
                            <h3 class="display-4 text-gold mb-0 serif-font">35+</h3>
                            <small class="text-white text-uppercase ls-1">Anni di Storia</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="text-uppercase text-gold fw-bold letter-spacing-2">La Nostra Filosofia</span>
                    <h2 class="section-title text-start mb-4 mt-2">Tradizione & <span class="serif-font fst-italic text-white">Innovazione</span></h2>
                    <p class="text-muted mb-4 lead">
                        Ogni piatto racconta una storia. La storia di ingredienti scelti all'alba, di mani sapienti che lavorano la pasta fresca, di profumi che evocano ricordi.
                    </p>
                    <p class="text-muted mb-5">
                        Sotto la guida dello Chef Giovanni Rossi, trasformiamo materie prime semplici in opere d'arte commestibili, rispettando la natura e i suoi tempi.
                    </p>

                    <div class="d-flex align-items-center gap-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 icon-circle-gold">
                                <i class="fas fa-leaf fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">Bio & Km0</h6>
                                <small class="text-muted">Solo prodotti stagionali</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 icon-circle-gold">
                                <i class="fas fa-wine-glass-alt fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">Cantina Premium</h6>
                                <small class="text-muted">Oltre 200 etichette</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="menu" class="py-5 position-relative bg-dark">
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden bg-z-0">
            <div class="position-absolute top-0 end-0 rounded-circle blur-3xl bg-blob"></div>
        </div>

        <div class="container py-5 position-relative z-1">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase text-gold fw-bold letter-spacing-2">Gusto Supremo</span>
                <h2 class="section-title">Il Nostro Menu</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card h-100 menu-item">
                        <div class="dish-category d-flex align-items-center justify-content-between">
                            <h3>Antipasti</h3>
                            <i class="fas fa-cheese text-muted opacity-25 fa-2x"></i>
                        </div>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Bruschetta Gourmet</h4>
                                    <span class="dish-price">€12</span>
                                </div>
                                <p class="dish-description">Pane ai 5 cereali, pomodorini confit, stracciatella di bufala, basilico cristallo.</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Tagliere Imperiale</h4>
                                    <span class="dish-price">€24</span>
                                </div>
                                <p class="dish-description">Selezione di salumi nobili, formaggi di grotta, miele al tartufo e noci.</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Tartare di Fassona</h4>
                                    <span class="dish-price">€18</span>
                                </div>
                                <p class="dish-description">Battuta al coltello, tuorlo marinato, capperi di Pantelleria, senape antica.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card h-100 menu-item">
                        <div class="dish-category d-flex align-items-center justify-content-between">
                            <h3>Primi Piatti</h3>
                            <i class="fas fa-utensils text-muted opacity-25 fa-2x"></i>
                        </div>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Carbonara 2.0</h4>
                                    <span class="dish-price">€16</span>
                                </div>
                                <p class="dish-description">Spaghettone Monograno, guanciale croccante, spuma di pecorino, pepe Sarawak.</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Risotto all'Oro</h4>
                                    <span class="dish-price">€22</span>
                                </div>
                                <p class="dish-description">Riso Carnaroli riserva, zafferano iraniano, foglia d'oro 24k, midollo.</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Ravioli del Plin</h4>
                                    <span class="dish-price">€18</span>
                                </div>
                                <p class="dish-description">Pasta fresca ai 30 tuorli, ripieno di arrosto, burro d'alpeggio e salvia.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card h-100 menu-item">
                        <div class="dish-category d-flex align-items-center justify-content-between">
                            <h3>Secondi Piatti</h3>
                            <i class="fas fa-drumstick-bite text-muted opacity-25 fa-2x"></i>
                        </div>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Filetto Rossini</h4>
                                    <span class="dish-price">€32</span>
                                </div>
                                <p class="dish-description">Filetto di manzo, scaloppa di foie gras, tartufo nero, salsa al Madeira.</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Polpo Croccante</h4>
                                    <span class="dish-price">€24</span>
                                </div>
                                <p class="dish-description">Tentacolo arrosto, crema di patate viola, olive taggiasche disidratate.</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name mb-0">Anatra all'Arancia</h4>
                                    <span class="dish-price">€26</span>
                                </div>
                                <p class="dish-description">Petto d'anatra laccato al miele, salsa all'arancia amara, indivia brasata.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-in">
                <a href="{{ asset('menu.pdf') }}" class="btn btn-outline-light px-5 py-3 rounded-pill fw-bold hover-scale">
                    <i class="fas fa-file-pdf me-2"></i> Scarica Menu Stagionale
                </a>
            </div>
        </div>
    </section>

    <section class="parallax-section d-flex align-items-center justify-content-center position-relative min-vh-50" style="background-image: url('{{ route('restaurant.image', ['filename' => 'about-bg.jpg']) }}');">
        <div class="overlay parallax-overlay-dark"></div>
        <div class="container content-wrapper text-center">
            <i class="fas fa-quote-left text-gold fa-3x mb-4 animate-float"></i>
            <h2 class="text-white display-5 serif-font mb-4 fst-italic" data-aos="zoom-in">"La vera cucina è una forma d'arte, un dono da condividere."</h2>
            <p class="lead text-white-50 text-uppercase letter-spacing-2">- Gualtiero Marchesi</p>
        </div>
    </section>

    <section id="contact" class="py-5 contact-section-bg">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="text-uppercase text-gold fw-bold">Contattaci</span>
                    <h2 class="section-title text-start text-white mb-4">La Tua Tavola Ti Aspetta</h2>
                    <p class="text-muted mb-5">
                        Per eventi privati, cene aziendali o richieste speciali, non esitare a contattarci direttamente.
                    </p>

                    <div class="contact-card p-4 mb-4">
                        <div class="d-flex mb-4 align-items-center">
                            <div class="contact-icon rounded-circle bg-dark p-2 me-3">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h5 class="text-white mb-1">Orari di Apertura</h5>
                                <p class="text-muted mb-0">Mar-Dom: 12:00-15:00 / 19:00-23:00</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4 align-items-center">
                            <div class="contact-icon rounded-circle bg-dark p-2 me-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h5 class="text-white mb-1">Dove Siamo</h5>
                                <p class="text-muted mb-0">Piazza Augusto Albini 10, Roma</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="contact-icon rounded-circle bg-dark p-2 me-3">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h5 class="text-white mb-1">Prenotazioni</h5>
                                <p class="text-muted mb-0">+39 06 1234567</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-links pt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-tripadvisor"></i></a>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="glass-card h-100" id="reservation">
                        <h2 class="serif-font text-white mb-4 text-center">Prenota Online</h2>
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control form-control-custom" id="name" name="name" value="{{ old('name') }}" required placeholder="Mario Rossi">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Telefono</label>
                                    <input type="tel" class="form-control form-control-custom" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="+39 ...">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-custom" id="email" name="email" value="{{ old('email') }}" required placeholder="email@esempio.com">
                                </div>
                                <div class="col-md-6">
                                    <label for="people" class="form-label">Ospiti</label>
                                    <select class="form-select form-control-custom" id="people" name="people" required>
                                        @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('people') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'persona' : 'persone' }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Data</label>
                                    <input type="date" class="form-control form-control-custom" id="date" name="date" value="{{ old('date') }}" required min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="time" class="form-label">Orario</label>
                                    <select class="form-select form-control-custom" id="time" name="time" required>
                                        <option value="" disabled {{ !old('time') ? 'selected' : '' }}>Seleziona orario</option>
                                        <optgroup label="Pranzo (12:00 - 13:45)">
                                            @for ($h = 12; $h <= 13; $h++)
                                            @for ($m = 0; $m < 60; $m += 15)
                                            @php
                                            $timeValue = sprintf('%02d:%02d', $h, $m);
                                            $timeLimit = ($h == 13 && $m > 45);
                                            @endphp
                                            @if (!$timeLimit)
                                            <option value="{{ $timeValue }}" {{ old('time') == $timeValue ? 'selected' : '' }}>{{ $timeValue }}</option>
                                            @endif
                                            @endfor
                                            @endfor
                                        </optgroup>
                                        <optgroup label="Cena (19:30 - 22:00)">
                                            @for ($h = 19; $h <= 22; $h++)
                                            @for ($m = 0; $m < 60; $m += 15)
                                            @php
                                            $timeValue = sprintf('%02d:%02d', $h, $m);
                                            $tooEarly = ($h == 19 && $m < 30);
                                            $tooLate = ($h == 22 && $m > 0);
                                            @endphp
                                            @if (!$tooEarly && !$tooLate)
                                            <option value="{{ $timeValue }}" {{ old('time') == $timeValue ? 'selected' : '' }}>{{ $timeValue }}</option>
                                            @endif
                                            @endfor
                                            @endfor
                                            <option value="22:00" {{ old('time') == '22:00' ? 'selected' : '' }}>22:00</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">Richieste Speciali</label>
                                    <textarea class="form-control form-control-custom" id="notes" name="notes" rows="2" placeholder="Allergie, tavolo preferito, ecc.">{{ old('notes') }}</textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary-custom w-100 py-3 fw-bold">CONFERMA PRENOTAZIONE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2971.3051977017053!2d12.482395075787636!3d41.86477966624845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13258a7e1448600f%3A0x4a1ae9829749f019!2sPiazza%20Augusto%20Albini%2C%2010%2C%2000154%20Roma%20RM!5e0!3m2!1sit!2sit!4v1756108690673!5m2!1sit!2sit" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <x-footer />

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Restaurant",
        "name": "Ristorante Buongusto",
        "image": "{{ asset('images/ristorante-preview.jpg') }}",
        "url": "{{ url('/') }}",
        "telephone": "+39 06 1234567",
        "email": "info@ristorantebuongusto.it",
        "priceRange": "€€-€€€",
        "servesCuisine": "Italiana",
        "description": "Ristorante Buongusto: Eccellenza culinaria italiana a Roma.",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Piazza Augusto Albini, 10",
            "addressLocality": "Roma",
            "postalCode": "00154",
            "addressCountry": "IT"
        }
    }
    </script>

    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-card border-0">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title text-gold serif-font" id="welcomeModalLabel">
                        <i class="fas fa-info-circle me-2"></i>Benvenuto al Ristorante Buongusto (Demo)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-white">
                    <p class="lead mb-4">
                        Questa è una versione di test del nostro sito web. Sentiti libero di esplorare, provare a prenotare e consultare la dashboard a tuo piacimento!
                    </p>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded bg-dark h-100 border border-secondary">
                                <h6 class="text-gold text-uppercase mb-3"><i class="fas fa-server me-2"></i>Backend (Architettura)</h6>
                                <p class="small text-muted mb-0">
                                    Powered by <strong>Laravel</strong>. Utilizza <strong>Eloquent ORM</strong> per interazioni efficienti con il DB e <strong>Controller RESTful</strong> per una gestione pulita delle risorse API-like.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded bg-dark h-100 border border-secondary">
                                <h6 class="text-gold text-uppercase mb-3"><i class="fas fa-paint-brush me-2"></i>Frontend (UI/UX)</h6>
                                <p class="small text-muted mb-0">
                                    Sviluppato con <strong>Blade Template Engine</strong> e <strong>Bootstrap 5</strong>. Implementa un design system personalizzato con effetti <em>Glassmorphism</em>, animazioni CSS3 e ottimizzazione degli asset tramite Vite.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-4 d-flex align-items-center mb-0 alert-gold" role="alert">
                        <i class="fas fa-exclamation-triangle me-3 fa-2x"></i>
                        <div>
                            <strong>Nota Importante</strong><br>
                            <small>Le funzionalità di gestione dashboard, che permettono di vedere tutte le prenotazioni, sono normalmente riservate agli amministratori. In questa demo sono aperte a tutti per scopi dimostrativi.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-primary-custom px-4" data-bs-dismiss="modal">Inizia l'Esperienza</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>