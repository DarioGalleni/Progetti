<x-layout>
    <!-- Hero Section -->
    <section id="home" class="hero-section vh-100 d-flex align-items-center justify-content-center text-white text-center"
        style="background: linear-gradient(rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.8)),url('{{ asset('media/img/home-section.jpg') }}');
            background-size: cover;
            background-position: center;">
        <div class="container">
            <h1 class="hero-title">Autentica Cucina Italiana</h1>
            <p class="hero-subtitle">Ingredienti freschi, sapori tradizionali, atmosfera accogliente</p>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                {{-- 
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                        alt="Chef preparing food" class="about-video">
                </div>  
                --}}
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <video class="about-video autoplay-on-view" muted playsinline preload="metadata" loop>
                        <source data-src="{{ asset('media/video/video.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">La Nostra Storia</h2>
                    <p class="mb-4">Fondato nel 1985, il Ristorante Buongusto porta avanti una tradizione culinaria che affonda le sue radici nella cucina italiana più autentica.</p>
                    <p class="mb-5">Il nostro chef, Giovanni Rossi, con oltre 30 anni di esperienza, seleziona personalmente gli ingredienti più freschi dai produttori locali per garantire la massima qualità in ogni piatto.</p>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-award contact-icon"></i>
                        <div>
                            <h4 class="mb-1">Premio "Miglior Ristorante Italiano" 2022</h4>
                            <p class="mb-0">Riconosciuto dalla Guida Gastronomica Italiana</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Il Nostro Menu</h2>
                <p class="section-subtitle">Scopri i nostri piatti preparati con passione e ingredienti di prima qualità</p>
            </div>
            <div class="row">
                <!-- Antipasti -->
                <div class="col-md-4 mb-4">
                    <div class="menu-item">
                        <div class="dish-category">
                            <h3>Antipasti</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Bruschetta al Pomodoro</h4>
                                    <span class="dish-price">€8</span>
                                </div>
                                <p class="dish-description">Pane tostato con pomodori freschi, aglio e basilico</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Antipasto Misto</h4>
                                    <span class="dish-price">€14</span>
                                </div>
                                <p class="dish-description">Selezione di salumi, formaggi e verdure sott'olio</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Carpaccio di Manzo</h4>
                                    <span class="dish-price">€12</span>
                                </div>
                                <p class="dish-description">Fettine sottili di manzo con scaglie di parmigiano e rucola</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Primi Piatti -->
                <div class="col-md-4 mb-4">
                    <div class="menu-item">
                        <div class="dish-category">
                            <h3>Primi Piatti</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Spaghetti Carbonara</h4>
                                    <span class="dish-price">€12</span>
                                </div>
                                <p class="dish-description">Con uova, guanciale, pecorino e pepe nero</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Risotto ai Funghi Porcini</h4>
                                    <span class="dish-price">€14</span>
                                </div>
                                <p class="dish-description">Risotto cremoso con funghi porcini freschi</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Lasagna alla Bolognese</h4>
                                    <span class="dish-price">€13</span>
                                </div>
                                <p class="dish-description">Pasta fresca con ragù di carne e besciamella</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Gnocchi al Pesto</h4>
                                    <span class="dish-price">€11</span>
                                </div>
                                <p class="dish-description">Gnocchi fatti in casa con pesto genovese</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Secondi Piatti -->
                <div class="col-md-4 mb-4">
                    <div class="menu-item">
                        <div class="dish-category">
                            <h3>Secondi Piatti</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Filetto di Manzo</h4>
                                    <span class="dish-price">€22</span>
                                </div>
                                <p class="dish-description">Con riduzione di vino rosso e patate al forno</p>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Branzino al Cartoccio</h4>
                                    <span class="dish-price">€18</span>
                                </div>
                                <p class="dish-description">Con verdure di stagione e erbe aromatiche</p>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="dish-name mb-0">Pollo alla Cacciatora</h4>
                                    <span class="dish-price">€16</span>
                                </div>
                                <p class="dish-description">Pollo cotto con pomodoro, olive e rosmarino</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ asset('menu.pdf') }}" class="btn btn-primary-custom" download>Scarica il Menu Completo (PDF)</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-white container-fluid">
        <div class="py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Cosa Dicono i Nostri Clienti</h2>
                <p class="section-subtitle">Le esperienze dei nostri ospiti</p>
            </div>
            <div class="testimonial-slider container-fluid">
                <div class="row testimonial-track">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-md-4 mb-4 testimonial-slide">
                            <x-card 
                                :stars="$testimonial['stars']"
                                :text="$testimonial['text']"
                                :author-img="$testimonial['authorImg']"
                                :author-name="$testimonial['authorName']"
                                :source="$testimonial['source']"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Reservation Section -->
    <section id="contact" class="contact-section">
        <div class="container-fluid">
            <div class="row">
                <!-- Contact -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="section-title text-white mb-4">Contattaci</h2>
                    <p class="mb-5">Siamo aperti dal martedì alla domenica, dalle 12:00 alle 15:00 e dalle 19:00 alle 23:00.</p>
                    <div class="contact-info">
                        <div class="d-flex mb-4">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <div>
                                <h4 class="mb-1">Indirizzo</h4>
                                <p class="mb-0">Piazza Augusto Albini, 10, 00154 Roma</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <i class="fas fa-phone-alt contact-icon"></i>
                            <div>
                                <h4 class="mb-1">Telefono</h4>
                                <p class="mb-0">+39 06 1234567</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-envelope contact-icon"></i>
                            <div>
                                <h4 class="mb-1">Email</h4>
                                <p class="mb-0">info@ristorantebuongusto.it</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-3">Seguici sui Social</h4>
                        <div>
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Reservation -->
                <div class="col-lg-6">
                    <h2 class="section-title text-white mb-4" id="reservation">Prenota un Tavolo</h2>
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="name" class="form-label">Nome e Cognome</label>
                                <input type="text" class="form-control form-control-custom" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefono</label>
                                <input type="tel" class="form-control form-control-custom" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-custom" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="people" class="form-label">Numero di persone</label>
                                <select class="form-select form-control-custom" id="people" name="people" required>
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('people') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'persona' : 'persone' }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="date" class="form-label">Data</label>
                                <input type="date" class="form-control form-control-custom" id="date" name="date" value="{{ old('date') }}" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="time" class="form-label">Ora</label>
                                <select class="form-select form-control-custom" id="time" name="time" required>
                                    <option value="" disabled {{ !old('time') ? 'selected' : '' }}>Seleziona un orario</option>
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
                        </div>
                        <div class="mb-4">
                            <label for="notes" class="form-label">Note aggiuntive</label>
                            <textarea class="form-control form-control-custom" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">Prenota Ora</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
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
    </section>

    <!-- Map -->
    <div class="map-container" style="height: 400px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2971.3051977017053!2d12.482395075787636!3d41.86477966624845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13258a7e1448600f%3A0x4a1ae9829749f019!2sPiazza%20Augusto%20Albini%2C%2010%2C%2000154%20Roma%20RM!5e0!3m2!1sit!2sit!4v1756108690673!5m2!1sit!2sit" 
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    
    <x-footer/>

    <!-- JSON-LD Schema per i motori di ricerca -->
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
        "description": "Fondato nel 1985, il Ristorante Buongusto porta avanti una tradizione culinaria che affonda le sue radici nella cucina italiana più autentica.",
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
        "hasMenu": {
            "@@type": "Menu",
            "hasMenuSection": [
                {
                    "@@type": "MenuSection",
                    "name": "Antipasti",
                    "hasMenuItem": [
                        {
                            "@@type": "MenuItem",
                            "name": "Bruschetta al Pomodoro",
                            "description": "Pane tostato con pomodori freschi, aglio e basilico",
                            "offers": {
                                "@@type": "Offer",
                                "price": "8.00",
                                "priceCurrency": "EUR"
                            }
                        },
                        {
                            "@@type": "MenuItem",
                            "name": "Antipasto Misto",
                            "description": "Selezione di salumi, formaggi e verdure sott'olio",
                            "offers": {
                                "@@type": "Offer",
                                "price": "14.00",
                                "priceCurrency": "EUR"
                            }
                        }
                    ]
                },
                {
                    "@@type": "MenuSection",
                    "name": "Primi Piatti",
                    "hasMenuItem": [
                        {
                            "@@type": "MenuItem",
                            "name": "Spaghetti Carbonara",
                            "description": "Con uova, guanciale, pecorino e pepe nero",
                            "offers": {
                                "@@type": "Offer",
                                "price": "12.00",
                                "priceCurrency": "EUR"
                            }
                        },
                        {
                            "@@type": "MenuItem",
                            "name": "Risotto ai Funghi Porcini",
                            "description": "Risotto cremoso con funghi porcini freschi",
                            "offers": {
                                "@@type": "Offer",
                                "price": "14.00",
                                "priceCurrency": "EUR"
                            }
                        }
                    ]
                }
            ]
        },
        "award": "Premio 'Miglior Ristorante Italiano' 2022 - Riconosciuto dalla Guida Gastronomica Italiana",
        "aggregateRating": {
            "@@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "450"
        }
    }
    </script>
</x-layout>
