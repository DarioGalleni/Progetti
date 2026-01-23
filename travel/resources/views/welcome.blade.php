<x-layout title="Home - StartJourney">

    <!-- redirect immagini su cloudfare -->
    <style>
        :root {
            --hero-bg: url('{{ Storage::url('images/header.webp') }}');
            --stats-bg: url('{{ Storage::url('images/stats.avif') }}');
            --divider-bg: url('{{ Storage::url('images/parallax_divider_1.avif') }}');
            --newsletter-bg: url('{{ Storage::url('images/newsletter.avif') }}');
        }
    </style>

    <!-- HERO SECTION -->
    <header
        class="d-flex align-items-center justify-content-center text-white hero-bg position-relative overflow-hidden top-0"
        role="banner">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div>
        <div class="position-absolute top-0 start-0 w-100 h-100 overlay-gradient"></div>
        <div class="container position-relative z-index-1 text-center">
            <span
                class="d-inline-block py-1 px-3 rounded-pill bg-white bg-opacity-25 border border-white border-opacity-50 backdrop-blur-sm mb-4 reveal">
                <span class="text-uppercase letter-spacing-2 small fw-bold">Esplora il Mondo con Noi</span>
            </span>
            <h1 class="display-1 fw-bold mb-4 hero-title reveal">Il Tuo Prossimo Viaggio <br> <span
                    class="text-gradient display-2 d-block mt-2">Inizia Qui</span></h1>
            <p class="lead fs-4 mb-5 fw-light text-white-50 reveal hero-description">
                Non offriamo semplici vacanze, ma esperienze trasformative disegnate su misura per te. Scopri
                destinazioni esclusive e itinerari unici.
            </p>
        </div>
    </header>

    <!-- HOW IT WORKS -->
    <section id="how-it-works" class="section-padding bg-white">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <p class="text-primary text-uppercase letter-spacing-2 fw-bold mb-2">Semplice e Veloce</p>
                <h2 class="display-4 fw-bold">Come Funziona</h2>
            </div>

            <div class="row g-4 position-relative">
                <div class="col-md-4 reveal">
                    <div class="step-card">
                        <div class="step-number">01</div>
                        <div class="step-content pt-4">
                            <div
                                class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-4 mb-4 shadow-sm">
                                <i class="bi bi-map fs-2"></i>
                            </div>
                            <h3 class="h4 fw-bold">Scegli la Meta</h3>
                            <p class="text-muted">Esplora le nostre collezioni curate o lasciati ispirare dalle tendenze
                                del momento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 reveal delay-1">
                    <div class="step-card">
                        <div class="step-number">02</div>
                        <div class="step-content pt-4">
                            <div
                                class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-4 mb-4 shadow-sm">
                                <i class="bi bi-calendar-check fs-2"></i>
                            </div>
                            <h3 class="h4 fw-bold">Prenota Facile</h3>
                            <p class="text-muted">Un processo di prenotazione fluido e sicuro, con assistenza dedicata
                                in ogni fase.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 reveal delay-2">
                    <div class="step-card">
                        <div class="step-number">03</div>
                        <div class="step-content pt-4">
                            <div
                                class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-4 mb-4 shadow-sm">
                                <i class="bi bi-camera fs-2"></i>
                            </div>
                            <h3 class="h4 fw-bold">Vivi l'Avventura</h3>
                            <p class="text-muted">Parti senza pensieri e preparati a collezionare ricordi indelebili.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRENDING CATEGORIES -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5 reveal">
                <div>
                    <h2 class="display-4 fw-bold mb-0">Categorie Trending</h2>
                    <p class="text-muted mb-0 mt-2">Cosa stanno cercando i nostri viaggiatori</p>
                </div>
                <a href="{{ route('journeys.index') }}" class="btn btn-link text-decoration-none fw-bold">Vedi tutto <i
                        class="bi bi-arrow-right"></i></a>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="category-card parallax-scroll scroll-transform" data-parallax-speed="0.1">
                        <div class="category-bg cat-img-1"></div>
                        <div class="category-overlay">
                            <h3 class="h4 fw-bold mb-1">Relax & Spa</h3>
                            <p class="small mb-0 opacity-75">Rigenera mente e corpo</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 reveal delay-1">
                    <div class="category-card parallax-scroll scroll-transform" data-parallax-speed="-0.1">
                        <div class="category-bg cat-img-2"></div>
                        <div class="category-overlay">
                            <h3 class="h4 fw-bold mb-1">Avventura</h3>
                            <p class="small mb-0 opacity-75">Per chi ama l'adrenalina</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 reveal delay-2">
                    <div class="category-card parallax-scroll scroll-transform" data-parallax-speed="0.15">
                        <div class="category-bg cat-img-3"></div>
                        <div class="category-overlay">
                            <h3 class="h4 fw-bold mb-1">Cultura</h3>
                            <p class="small mb-0 opacity-75">Immergiti nella storia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 reveal delay-2">
                    <div class="category-card parallax-scroll scroll-transform" data-parallax-speed="-0.05">
                        <div class="category-bg cat-img-4"></div>
                        <div class="category-overlay">
                            <h3 class="h4 fw-bold mb-1">Viaggi di Nozze</h3>
                            <p class="small mb-0 opacity-75">Romantici e indimenticabili</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BENTO GRID FEATURES -->
    <section class="section-padding bg-white custom-cursor" aria-labelledby="about-heading">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <p class="text-primary text-uppercase letter-spacing-2 fw-bold mb-2">Perché scegliere noi</p>
                <h2 id="about-heading" class="display-4 fw-bold">L'Eccellenza StartJourney</h2>
            </div>

            <div class="bento-grid">
                <!-- Large Item: Main Value Prop -->
                <div class="bento-item-large reveal">
                    <div class="bento-card bg-dark text-white position-relative overflow-hidden border-0">
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-50"
                            style="background: url('{{ Storage::url('images/features.avif') }}') center/cover;"></div>
                        <div class="position-relative z-index-1 p-4 d-flex flex-column justify-content-end h-100">
                            <div class="mb-3 text-warning">
                                <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i
                                    class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <h3 class="display-6 fw-bold mb-3">Oltre 15 anni di viaggi perfetti</h3>
                            <p class="lead mb-0 opacity-90">Costruiamo ricordi curati in ogni minimo dettaglio. La tua
                                felicità è la nostra missione principale.</p>
                        </div>
                    </div>
                </div>

                <!-- Medium Item: Safety -->
                <div class="bento-item-medium reveal delay-1">
                    <div class="bento-card bg-primary bg-opacity-10 border-0">
                        <i class="bi bi-shield-check fs-1 text-primary mb-3"></i>
                        <h3 class="h4 fw-bold">Sicurezza Totale</h3>
                        <p class="text-muted mb-0">Assistenza H24 in tutto il mondo e coperture assicurative premium
                            incluse in ogni pacchetto.</p>
                    </div>
                </div>

                <!-- Small Item: Sustainability -->
                <div class="reveal delay-2">
                    <div class="bento-card">
                        <i class="bi bi-tree-fill fs-2 text-success mb-3"></i>
                        <h3 class="h5 fw-bold">Eco-Friendly</h3>
                        <p class="small text-muted mb-0">Viaggi a impatto zero.</p>
                    </div>
                </div>

                <!-- Small Item: Customization -->
                <div class="reveal delay-2">
                    <div class="bento-card">
                        <i class="bi bi-sliders fs-2 text-info mb-3"></i>
                        <h3 class="h5 fw-bold">100% Personalizzabile</h3>
                        <p class="small text-muted mb-0">Itinerari su misura per te.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS (EXISTING - REFRESHED) -->
    <section class="parallax-section py-5 reveal stats-container stats-bg" aria-labelledby="stats-heading">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75" aria-hidden="true"></div>
        <div class="container position-relative z-index-1 py-5">
            <h2 id="stats-heading" class="visually-hidden">Statistiche azienda</h2>
            <div class="row g-4 text-center text-white">
                <div class="col-md-3">
                    <i class="bi bi-emoji-smile fs-1 mb-3 d-block text-warning"></i>
                    <p class="display-4 fw-bold mb-0 counter-value" data-target="12000" data-suffix="+"
                        aria-live="polite">0</p>
                    <p class="text-white-50 text-uppercase letter-spacing-1 small">Clienti Felici</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-geo-alt fs-1 mb-3 d-block text-danger"></i>
                    <p class="display-4 fw-bold mb-0 counter-value" data-target="500" data-suffix="+"
                        aria-live="polite">0</p>
                    <p class="text-white-50 text-uppercase letter-spacing-1 small">Destinazioni</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-award fs-1 mb-3 d-block text-info"></i>
                    <p class="display-4 fw-bold mb-0 counter-value" data-target="15" data-suffix="" aria-live="polite">0
                    </p>
                    <p class="text-white-50 text-uppercase letter-spacing-1 small">Anni di Successi</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-headset fs-1 mb-3 d-block text-success"></i>
                    <p class="display-4 fw-bold mb-0 counter-value" data-target="24" data-suffix="/7"
                        aria-live="polite">0</p>
                    <p class="text-white-50 text-uppercase letter-spacing-1 small">Supporto</p>
                </div>
            </div>
        </div>
    </section>

    <!-- JOURNEYS PREVIEW -->
    <section class="section-padding bg-light" aria-labelledby="journeys-heading">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <p class="text-primary text-uppercase letter-spacing-2 fw-bold mb-2">Lasciati Ispirare</p>
                <h2 id="journeys-heading" class="display-4 fw-bold">Viaggi in Evidenza</h2>
            </div>

            <div class="row g-4">
                @foreach($journeys as $journey)
                    <article class="col-md-4 reveal">
                        <div class="card glass-card h-100 border-0 overflow-hidden rounded-4">
                            <div class="position-relative journey-card-img-container">
                                <img src="{{ $journey->image }}"
                                    class="w-100 h-100 object-fit-cover transition-all hover-scale"
                                    alt="Immagine di {{ $journey->title }}" loading="lazy">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-white text-dark rounded-pill px-3 py-2 fw-bold shadow-sm">
                                        {{ $journey->duration_days }} Giorni
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t from-black">
                                    <h3 class="h4 text-white fw-bold mb-0 text-shadow">{{ $journey->title }}</h3>
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <p class="text-muted mb-4 flex-grow-1">{{ Str::limit($journey->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div>
                                        <small class="text-muted d-block text-uppercase small">A partire da</small>
                                        <strong
                                            class="h4 text-primary fw-bold mb-0">€{{ number_format($journey->price, 0, ',', '.') }}</strong>
                                    </div>
                                    <a href="{{ route('journeys.show', $journey) }}"
                                        class="btn btn-outline-primary rounded-circle p-3 d-flex align-items-center justify-content-center btn-circle-lg shadow-sm"
                                        aria-label="Scopri dettagli {{ $journey->title }}">
                                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-5 reveal">
                <a href="{{ route('journeys.index') }}"
                    class="btn btn-dark btn-lg px-5 py-3 rounded-pill hover-scale shadow"
                    aria-label="Visualizza tutte le destinazioni">
                    Esplora Tutte le Destinazioni
                </a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="section-padding bg-white" aria-labelledby="testimonials-heading">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <h2 id="testimonials-heading" class="display-4 fw-bold">Dicono di noi</h2>
            </div>
            <!-- (Keeping the loop/content similiar but wrapped in a carousel or grid? Stick to grid for now but polished) -->
            <div class="row g-4">
                <div class="col-md-4 reveal">
                    <div class="card border-0 shadow-lg p-4 h-100 rounded-4 bg-light position-relative parallax-scroll scroll-transform"
                        data-parallax-speed="0.05">
                        <i class="bi bi-quote fs-1 text-primary opacity-25 position-absolute top-0 start-0 m-3"></i>
                        <div class="card-body position-relative z-index-1">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <blockquote class="mb-4 fst-italic text-muted">"Un'esperienza che mi ha cambiato la vita.
                                Perfetto in ogni dettaglio."</blockquote>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u=marco"
                                    class="rounded-circle me-3 border border-3 border-white shadow-sm" width="50"
                                    height="50" loading="lazy" alt="Marco">
                                <div>
                                    <h5 class="fw-bold mb-0 h6">Marco Rossi</h5>
                                    <small class="text-muted">Giappone</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ... adding other 2 testimonials similarly ... -->
                <div class="col-md-4 reveal delay-1">
                    <div class="card border-0 shadow-lg p-4 h-100 rounded-4 bg-light position-relative">
                        <i class="bi bi-quote fs-1 text-primary opacity-25 position-absolute top-0 start-0 m-3"></i>
                        <div class="card-body position-relative z-index-1">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <blockquote class="mb-4 fst-italic text-muted">"Tutto organizzato alla perfezione. Non ho
                                dovuto pensare a nulla."</blockquote>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u=giulia"
                                    class="rounded-circle me-3 border border-3 border-white shadow-sm" width="50"
                                    height="50" loading="lazy" alt="Giulia">
                                <div>
                                    <h5 class="fw-bold mb-0 h6">Giulia Bianchi</h5>
                                    <small class="text-muted">Maldive</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 reveal delay-2">
                    <div class="card border-0 shadow-lg p-4 h-100 rounded-4 bg-light position-relative">
                        <i class="bi bi-quote fs-1 text-primary opacity-25 position-absolute top-0 start-0 m-3"></i>
                        <div class="card-body position-relative z-index-1">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <blockquote class="mb-4 fst-italic text-muted">"Il miglior viaggio che abbia mai fatto.
                                Consigliatissimi!"</blockquote>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u=luca"
                                    class="rounded-circle me-3 border border-3 border-white shadow-sm" width="50"
                                    height="50" loading="lazy" alt="Luca">
                                <div>
                                    <h5 class="fw-bold mb-0 h6">Luca Verdi</h5>
                                    <small class="text-muted">Kenya</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION (NEW) -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <h2 class="display-4 fw-bold">Domande Frequenti</h2>
                <p class="text-muted">Tutto quello che devi sapere prima di partire</p>
            </div>

            <div class="row justify-content-center reveal">
                <div class="col-lg-8">
                    <div class="accordion accordion-flush" id="faqAccordion">
                        <div
                            class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent shadow-none fw-bold fs-5"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    I voli sono inclusi nei pacchetti?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Generalmente i nostri pacchetti base non includono i voli internazionali per darti
                                    massima flessibilità sulle date e sugli aeroporti di partenza. Tuttavia, possiamo
                                    occuparci della biglietteria aerea su richiesta.
                                </div>
                            </div>
                        </div>
                        <div
                            class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent shadow-none fw-bold fs-5"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Quali sono le politiche di cancellazione?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Offriamo polizze di cancellazione flessibili. Fino a 30 giorni prima della partenza
                                    è possibile ottenere un rimborso del 80%. Consigliamo sempre di sottoscrivere la
                                    nostra assicurazione "Annullamento Senza Pensieri".
                                </div>
                            </div>
                        </div>
                        <div
                            class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent shadow-none fw-bold fs-5"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    I viaggi sono adatti a famiglie con bambini?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Assolutamente sì! Molti dei nostri itinerari sono "Family Friendly" con attività
                                    pensate per i più piccoli e ritmi di viaggio rilassati. Cerca il bollino "Family"
                                    nei nostri pacchetti.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="parallax-section d-flex align-items-center justify-content-center newsletter-bg position-relative"
        aria-labelledby="newsletter-heading">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-75 multiply-blend"></div>
        <div class="container position-relative z-index-1 text-center text-white reveal">
            <h2 id="newsletter-heading" class="display-3 fw-bold mb-4">Resta Ispirato</h2>
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <p class="fs-5 opacity-90 mb-5">
                        Ricevi guide esclusive, sconti riservati e dosi settimanali di voglia di viaggiare. Niente spam,
                        promesso.
                    </p>
                    <form class="row g-2 justify-content-center">
                        <div class="col-md-7">
                            <input type="email"
                                class="form-control form-control-lg rounded-pill px-4 border-0 shadow-lg"
                                placeholder="La tua email..." required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit"
                                class="btn btn-warning btn-lg rounded-pill px-4 fw-bold w-100 shadow-lg hover-scale">Iscriviti
                                Ora</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>

<!-- Welcome Modal -->
<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-2xl rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white p-4">
                <h5 class="modal-title fw-bold d-flex align-items-center" id="welcomeModalLabel">
                    <i class="bi bi-info-circle-fill me-2 fs-4"></i> Benvenuto in StartJourney (Demo)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <p class="lead text-muted mb-4">Questa è una <strong>versione di test</strong> del nostro sito web.
                    Sentiti libero di esplorare, aggiungere, modificare ed eliminare viaggi a tuo piacimento!</p>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-3 h-100 border">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-code-slash me-2"></i> Backend
                                (Architettura)</h6>
                            <p class="small text-muted mb-0">Powered by <strong>Laravel 12</strong>. Utilizza
                                <strong>Eloquent ORM</strong> per interazioni efficienti con il DB, <strong>Storage
                                    Facades</strong> per la gestione asincrona dei file su Cloud (S3), e Controller
                                <strong>RESTful</strong> per una gestione pulita delle risorse API-like.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-3 h-100 border">
                            <h6 class="fw-bold text-success mb-3"><i class="bi bi-palette me-2"></i> Frontend (UI/UX)
                            </h6>
                            <p class="small text-muted mb-0">Sviluppato con <strong>Blade Template Engine</strong> e
                                <strong>Bootstrap 5</strong>. Implementa un design system personalizzato con effetti
                                <strong>Glassmorphism</strong>, animazioni CSS3 e ottimizzazione degli asset tramite
                                <strong>Vite</strong>.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning border-0 d-flex align-items-start rounded-3">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3 mt-1"></i>
                    <div>
                        <strong class="d-block mb-1">Nota Importante</strong>
                        <p class="small mb-0">Le funzionalità di gestione, tasto <strong>"Nuovo"</strong>,
                            <strong>Modifica</strong> ed
                            <strong>Elimina</strong> sono normalmente riservate agli amministratori. In questa demo sono
                            aperte a tutti
                            per scopi dimostrativi.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light p-4 border-0 justify-content-center">
                <button type="button" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm"
                    data-bs-dismiss="modal">
                    Ho Capito, Fammi Entrare!
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Controlla se la modale è già stata mostrata in questa sessione
        if (!sessionStorage.getItem('welcomeModalShown')) {
            var myModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
            myModal.show();
            // Imposta il flag per non mostrarla più in questa sessione (opzionale, rimuovere riga sotto se si vuole sempre vedere)
            // sessionStorage.setItem('welcomeModalShown', 'true');
        }
    });
</script>