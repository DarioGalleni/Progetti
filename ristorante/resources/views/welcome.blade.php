<x-layout>
    <!-- Sezione Hero con Parallax -->
    <section id="home" class="hero-section parallax-section"
        style="background-image: url('{{ route('restaurant.image', ['filename' => 'home-section.jpg']) }}');">
        <div class="overlay"></div>
        <div class="container content-wrapper text-center text-white">
            <span class="d-block mb-3 text-uppercase letter-spacing-2" data-aos="fade-up"
                style="color: var(--primary-color);">Benvenuti</span>
            <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">Ristorante Buongusto</h1>
            <p class="hero-subtitle mb-5" data-aos="fade-up" data-aos-delay="200">
                <span
                    style="border-top: 1px solid var(--primary-color); border-bottom: 1px solid var(--primary-color); padding: 10px 0;">
                    Eccellenza Italiana dal 1985
                </span>
            </p>
            <a href="#reservation" class="btn btn-primary-custom" data-aos="fade-up" data-aos-delay="300">Prenota un
                Tavolo</a>
        </div>
    </section>

    <!-- Sezione Chi Siamo -->
    <section id="about" class="parallax-section py-5 d-flex align-items-center" 
             style="background-image: url('{{ route('restaurant.image', ['filename' => 'about-bg.jpg']) }}'); min-height: 80vh;">
        <div class="overlay"></div>
        <div class="container content-wrapper py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="video-container position-relative">
                        <video class="w-100 d-block" autoplay muted loop playsinline style="border-radius: 16px;">
                            <source src="{{ route('restaurant.image', ['filename' => 'video.mp4']) }}" type="video/mp4">
                        </video>
                        <div
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 15px; background: rgba(0,0,0,0.7); border-radius: 8px;">
                            <h5 class="mb-0 text-white serif-font">L'Arte della Preparazione</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl-lg-5" data-aos="fade-left">
                    <span class="text-uppercase"
                        style="color: var(--primary-color); letter-spacing: 1px; font-size: 0.9rem;">La Nostra
                        Storia</span>
                    <h2 class="section-title text-start text-white mb-4">Tradizione & Passione</h2>
                    <p class="text-white mb-4 lead" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Ogni piatto racconta una storia di sapori autentici, tramandati di
                        generazione in generazione e perfezionati con tecniche moderne.</p>
                    <p class="text-light mb-5" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Il nostro chef, Giovanni Rossi, seleziona personalmente ogni
                        ingrediente dai migliori produttori locali. Crediamo che la qualità della materia prima sia il
                        vero segreto della cucina italiana.</p>

                    <div class="d-flex align-items-center p-3"
                        style="background: rgba(0,0,0,0.6); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px;">
                        <i class="fas fa-award contact-icon fa-2x"></i>
                        <div>
                            <h5 class="mb-1 text-white">Premio "Miglior Ristorante Italiano" 2022</h5>
                            <small class="text-muted">Guida Gastronomica Italiana</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sezione Menu -->
    <section id="menu" class="py-5 bg-dark position-relative">
        <!-- Overlay texture opzionale -->
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-uppercase" style="color: var(--primary-color);">Scopri</span>
                <h2 class="section-title">Il Nostro Menu</h2>
                <div style="width: 60px; height: 2px; background: var(--primary-color); margin: 0 auto;"></div>
            </div>

            <div class="row">
                <!-- Antipasti -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card h-100 menu-item">
                        <div class="dish-category">
                            <h3>Antipasti</h3>
                        </div>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Bruschetta al Pomodoro</h4>
                                    <span class="dish-price">€8</span>
                                </div>
                                <p class="dish-description">Pane tostato, pomodori San Marzano, basilico fresco, olio
                                    EVO.</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Antipasto Misto</h4>
                                    <span class="dish-price">€14</span>
                                </div>
                                <p class="dish-description">Prosciutto di Parma 24 mesi, mozzarelline, verdure
                                    grigliate.</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Carpaccio di Manzo</h4>
                                    <span class="dish-price">€12</span>
                                </div>
                                <p class="dish-description">Manzo marinato, rucola selvatica, scaglie di Grana Padano.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Primi Piatti -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card h-100 menu-item">
                        <div class="dish-category">
                            <h3>Primi Piatti</h3>
                        </div>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Spaghetti Carbonara</h4>
                                    <span class="dish-price">€12</span>
                                </div>
                                <p class="dish-description">Guanciale croccante, tuorlo d'uovo bio, Pecorino Romano,
                                    pepe nero.</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Risotto ai Porcini</h4>
                                    <span class="dish-price">€14</span>
                                </div>
                                <p class="dish-description">Riso Carnaroli, porcini freschi trifolati, mantecatura al
                                    burro.</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Gnocchi al Pesto</h4>
                                    <span class="dish-price">€11</span>
                                </div>
                                <p class="dish-description">Gnocchi di patate fatti a mano, pesto genovese autentico.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Secondi Piatti -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card h-100 menu-item">
                        <div class="dish-category">
                            <h3>Secondi Piatti</h3>
                        </div>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Filetto di Manzo</h4>
                                    <span class="dish-price">€22</span>
                                </div>
                                <p class="dish-description">Filetto alla griglia, riduzione al Chianti, patate novelle.
                                </p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Branzino al Cartoccio</h4>
                                    <span class="dish-price">€18</span>
                                </div>
                                <p class="dish-description">Filetto di branzino, pomodorini, olive taggiasche, capperi.
                                </p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-baseline mb-2">
                                    <h4 class="dish-name text-white mb-0">Pollo alla Cacciatora</h4>
                                    <span class="dish-price">€16</span>
                                </div>
                                <p class="dish-description">Pollo ruspante stufato, salsa di pomodoro, aromi dell'orto.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-in">
                <a href="{{ asset('menu.pdf') }}" class="btn btn-primary-custom px-5" download>
                    <i class="fas fa-file-pdf me-2"></i> Scarica Menu Completo
                </a>
            </div>
        </div>
    </section>

    <!-- Sezione Break Parallax -->
    <section class="parallax-section d-flex align-items-center justify-content-center"
        style="height: 400px; background-image: url('{{ route('restaurant.image', ['filename' => 'home-section.jpg']) }}');">
        <!-- Usiamo la stessa immagine o un'altra se disponibile -->
        <div class="overlay"></div>
        <div class="container content-wrapper text-center">
            <h2 class="text-white display-4 serif-font mb-4" data-aos="zoom-in">Un'Esperienza Unica</h2>
            <p class="lead text-white-50">Dove il gusto incontra l'eleganza.</p>
        </div>
    </section>

    <!-- Sezione Contatti & Prenotazioni -->
    <section id="contact" class="py-5" style="background-color: #0F0F0F;">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Info Contatti -->
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="text-uppercase" style="color: var(--primary-color);">Informazioni</span>
                    <h2 class="section-title text-start text-white mb-4">Vieni a Trovarci</h2>
                    <p class="text-muted mb-5">Siamo aperti dal martedÃ¬ alla domenica. Prenota il tuo tavolo per
                        assicurarti un posto nella nostra sala.</p>

                    <div class="contact-card p-4 mb-4" style="background: rgba(255,255,255,0.03); border-radius: 12px;">
                        <div class="d-flex mb-4">
                            <i class="fas fa-clock contact-icon mt-1"></i>
                            <div>
                                <h5 class="text-white mb-2">Orari di Apertura</h5>
                                <p class="text-muted mb-0">Pranzo: 12:00 - 15:00</p>
                                <p class="text-muted mb-0">Cena: 19:00 - 23:00</p>
                                <small class="text-danger mt-1 d-block">Chiuso il LunedÃ¬</small>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <i class="fas fa-map-marker-alt contact-icon mt-1"></i>
                            <div>
                                <h5 class="text-white mb-2">Dove Siamo</h5>
                                <p class="text-muted mb-0">Piazza Augusto Albini, 10</p>
                                <p class="text-muted mb-0">00154 Roma, Italia</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-phone-alt contact-icon mt-1"></i>
                            <div>
                                <h5 class="text-white mb-2">Contatti</h5>
                                <p class="text-muted mb-0">+39 06 1234567</p>
                                <p class="text-muted mb-0">info@ristorantebuongusto.it</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-links pt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-tripadvisor"></i></a>
                    </div>
                </div>

                <!-- Form Prenotazioni -->
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="glass-card h-100" id="reservation">
                        <h2 class="serif-font text-white mb-4 text-center">Prenota il tuo Tavolo</h2>
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control form-control-custom" id="name" name="name"
                                        value="{{ old('name') }}" required placeholder="Mario Rossi">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Telefono</label>
                                    <input type="tel" class="form-control form-control-custom" id="phone" name="phone"
                                        value="{{ old('phone') }}" required placeholder="+39 ...">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-custom" id="email" name="email"
                                        value="{{ old('email') }}" required placeholder="email@esempio.com">
                                </div>
                                <div class="col-md-6">
                                    <label for="people" class="form-label">Ospiti</label>
                                    <select class="form-select form-control-custom" id="people" name="people" required>
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}" {{ old('people') == $i ? 'selected' : '' }}>{{ $i }}
                                                {{ $i == 1 ? 'persona' : 'persone' }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Data</label>
                                    <input type="date" class="form-control form-control-custom" id="date" name="date"
                                        value="{{ old('date') }}" required min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="time" class="form-label">Orario</label>
                                    <select class="form-select form-control-custom" id="time" name="time" required>
                                        <option value="" disabled {{ !old('time') ? 'selected' : '' }}>Seleziona orario
                                        </option>
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
                                            <option value="22:00" {{ old('time') == '22:00' ? 'selected' : '' }}>22:00
                                            </option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">Richieste Speciali</label>
                                    <textarea class="form-control form-control-custom" id="notes" name="notes" rows="2"
                                        placeholder="Allergie, tavolo preferito, ecc.">{{ old('notes') }}</textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary-custom w-100 py-3 fw-bold">Conferma
                                        Prenotazione</button>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3"
                                style="background-color: rgba(220, 53, 69, 0.2); border-color: #dc3545; color: #ff8b94;">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mappa Full Width -->
    <div class="map-container" style="height: 450px; filter: grayscale(100%) invert(90%);" data-aos="fade-in">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2971.3051977017053!2d12.482395075787636!3d41.86477966624845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13258a7e1448600f%3A0x4a1ae9829749f019!2sPiazza%20Augusto%20Albini%2C%2010%2C%2000154%20Roma%20RM!5e0!3m2!1sit!2sit!4v1756108690673!5m2!1sit!2sit"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <x-footer />

    <!-- JSON-LD Schema (Invariato per SEO) -->
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
        "description": "Fondato nel 1985, il Ristorante Buongusto porta avanti una tradizione culinaria più autentica.",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Piazza Augusto Albini, 10",
            "addressLocality": "Roma",
            "postalCode": "00154",
            "addressCountry": "IT"
        },
        "geo": {
            "@@type": "GeoCoordinates",
            "latitude": 41.86488,
            "longitude": 12.48594
        },
        "openingHoursSpecification": [
            {
                "@@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                "opens": "12:00",
                "closes": "15:00"
            },
            {
                "@@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                "opens": "19:00",
                "closes": "23:00"
            }
        ],
        "menu": "{{ url('/menu') }}",
        "award": "Premio 'Miglior Ristorante Italiano' 2022"
    }
    </script>

    <!-- Script AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 1000,
                    once: true,
                    offset: 50,
                    easing: 'ease-in-out'
                });
            }
        });
    </script>
</x-layout>
