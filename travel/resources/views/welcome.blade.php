<x-layout>
<!-- Hero Section -->
    <header class="hero-section" id="home">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">Scopri il mondo con noi</h1>
                <p class="lead mb-4">Pianifica la tua vacanza perfetta con i nostri esperti. Viaggi su misura per ogni esigenza e budget.</p>
                <a href="#destinations" class="btn btn-accent btn-lg me-2" aria-label="Scopri le nostre destinazioni">
                    <i class="fas fa-map-marked-alt me-2"></i>Scopri le destinazioni
                </a>
                <a href="#contact" class="btn btn-outline-light btn-lg" aria-label="Contattaci per maggiori informazioni">
                    <i class="fas fa-phone-alt me-2"></i>Contattaci
                </a>
            </div>
        </div>
    </header>

    <!-- Destinations Section -->
    <main class="py-5" id="destinations">
        <div class="container">
            <h2 class="text-center section-title">Le nostre destinazioni top</h2>
            <div class="row">
                <!-- Destination 1 -->
                <div class="col-md-4">
                    <article class="destination-card">
                        <div class="position-relative">
                            <img src="https://images.lonelyplanetitalia.it/uploads/il-tempio-di-pura-ulun-danu-bratan-allalba-balicgu-820.jpg?q=80&p=slider&s=ee8bf88b05570823302fca07bcdc547a" alt="Bali" class="img-fluid destination-img">
                            <div class="price-tag">€1.299</div>
                        </div>
                        <div class="p-4">
                            <h3>Bali, Indonesia</h3>
                            <p class="text-muted"><i class="fas fa-calendar-alt me-2"></i>8 giorni / 7 notti</p>
                            <p>Scopri le spiagge paradisiache, i templi sacri e la cultura unica di Bali.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                </div>
                                {{-- <a href="#" class="btn btn-sm btn-primary" aria-label="Dettagli del viaggio a Bali">Dettagli</a> --}}
                            </div>
                        </div>
                    </article>
                </div>
                
                <!-- Destination 2 -->
                <div class="col-md-4">
                    <article class="destination-card">
                        <div class="position-relative">
                            <img src="https://cdn2.paraty.es/demo14/images/ef7d8f6c8bff807" alt="Santorini" class="img-fluid destination-img">
                            <div class="price-tag">€899</div>
                        </div>
                        <div class="p-4">
                            <h3>Santorini, Grecia</h3>
                            <p class="text-muted"><i class="fas fa-calendar-alt me-2"></i>6 giorni / 5 notti</p>
                            <p>Case bianche, tramonti mozzafiato e il mare cristallino dell'Egeo.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                                {{-- <a href="#" class="btn btn-sm btn-primary" aria-label="Dettagli del viaggio a Santorini">Dettagli</a> --}}
                            </div>
                        </div>
                    </article>
                </div>
                
                <!-- Destination 3 -->
                <div class="col-md-4">
                    <article class="destination-card">
                        <div class="position-relative">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRi4sX87VY9hnQGyebt2t0aYuu9bpKDhhokOw&s" alt="Kyoto" class="img-fluid destination-img">
                            <div class="price-tag">€1.799</div>
                        </div>
                        <div class="p-4">
                            <h3>Kyoto, Giappone</h3>
                            <p class="text-muted"><i class="fas fa-calendar-alt me-2"></i>10 giorni / 9 notti</p>
                            <p>Templi antichi, giardini zen e la tradizione giapponese autentica.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                </div>
                                {{-- <a href="#" class="btn btn-sm btn-primary" aria-label="Dettagli del viaggio a Kyoto">Dettagli</a> --}}
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('destinations.index') }}" class="btn btn-primary btn-lg" aria-label="Vedi tutte le destinazioni disponibili">
                    <i class="fas fa-globe-americas me-2"></i>Vedi tutte le destinazioni
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Team di viaggio" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">La nostra agenzia</h2>
                    <p class="lead">Esperti di viaggi dal 2005, abbiamo aiutato migliaia di clienti a realizzare i loro sogni di viaggio.</p>
                    <p>Sunset Travel nasce dalla passione per il viaggio e dalla voglia di condividere esperienze uniche. Il nostro team di esperti conosce personalmente ogni destinazione che proponiamo e può consigliarti al meglio per creare il viaggio perfetto per te.</p>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-passport fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">Esperienza</h3>
                                    <p class="mb-0">18 anni nel settore</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-globe-europe fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">Destinazioni</h3>
                                    <p class="mb-0">Oltre 50 paesi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-smile fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">Clienti soddisfatti</h3>
                                    <p class="mb-0">10.000+ viaggi organizzati</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-headset fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">Assistenza</h3>
                                    <p class="mb-0">24/7 durante il viaggio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5" id="testimonials">
        <div class="container">
            <h2 class="text-center section-title">Cosa dicono i nostri clienti</h2>
            <div class="row">
                <div class="col-md-4">
                    <figure class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Maria Rossi" class="testimonial-img">
                        <figcaption>
                            <h3>Maria Rossi</h3>
                            <p class="text-muted">Viaggio in Giappone</p>
                            <p>"L'organizzazione è stata perfetta, ogni dettaglio curato nei minimi particolari. Consiglio Sunset Travel a chiunque voglia vivere un'esperienza di viaggio senza pensieri."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Luigi Bianchi" class="testimonial-img">
                        <figcaption>
                            <h3>Luigi Bianchi</h3>
                            <p class="text-muted">Viaggio in Thailandia</p>
                            <p>"Ho viaggiato con Sunset Travel due volte e ogni volta è stata un'esperienza fantastica. L'agenzia ha saputo consigliarmi itinerari fuori dai soliti percorsi turistici."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="testimonial-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Giulia Verdi" class="testimonial-img">
                        <figcaption>
                            <h3>Giulia Verdi</h3>
                            <p class="text-muted">Viaggio in Messico</p>
                            <p>"Assistenza clienti eccellente! Quando abbiamo avuto un piccolo problema con il volo, si sono occupati di tutto risolvendolo in tempi record. Tornerò sicuramente a viaggiare con loro."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </main>

    <!-- Contact Section -->
    <section class="py-5 contact-section" id="contact">
        <div class="container">
            <h2 class="text-center section-title">Contattaci</h2>
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="text-center mb-5">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Dove siamo</h3>
                        <address>
                            Via del Viaggio, 123<br>
                            00100 Roma, Italia
                        </address>
                    </div>
                    <div class="text-center mb-5">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Telefono</h3>
                        <p>+39 06 1234567<br>Lun-Ven: 9:00-18:00</p>
                    </div>
                    <div class="text-center">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email</h3>
                        <p><a href="mailto:info@sunsattravel.it">info@sunsattravel.it</a><br><a href="mailto:assistenza@sunsattravel.it">assistenza@sunsattravel.it</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <h3 class="mb-4">Richiedi informazioni</h3>
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="surname" class="form-label">Cognome</label>
                                        <input type="text" class="form-control" id="surname" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefono</label>
                                    <input type="tel" class="form-control" id="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="destination" class="form-label">Destinazione di interesse</label>
                                    <select class="form-select" id="destination">
                                        <option selected>Scegli una destinazione</option>
                                        <option value="bali">Bali, Indonesia</option>
                                        <option value="santorini">Santorini, Grecia</option>
                                        <option value="kyoto">Kyoto, Giappone</option>
                                        <option value="altre">Altre destinazioni</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Messaggio</label>
                                    <textarea class="form-control" id="message" rows="4"></textarea>
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="privacy" required>
                                    <label class="form-check-label" for="privacy">
                                        Accetto l'informativa sulla privacy
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Invia richiesta
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h3 class="mb-0">Iscriviti alla nostra newsletter</h3>
                    <p class="mb-0">Ricevi offerte esclusive e ispirazione per i tuoi prossimi viaggi</p>
                </div>
                <div class="col-lg-6">
                    <form class="row g-2">
                        <div class="col-8">
                            <input type="email" class="form-control form-control-lg" placeholder="La tua email" aria-label="Inserisci la tua email per iscriverti alla newsletter">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-accent btn-lg w-100">Iscriviti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-layout>