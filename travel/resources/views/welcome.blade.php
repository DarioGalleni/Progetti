<x-layout title="Home">
    <style>
        :root {
            --hero-bg: url('{{ Storage::url('images/header.webp') }}');
            --stats-bg: url('{{ Storage::url('images/stats.avif') }}');
            --divider-bg: url('{{ Storage::url('images/parallax_divider_1.avif') }}');
            --newsletter-bg: url('{{ Storage::url('images/newsletter.avif') }}');
        }
    </style>
    <header class="parallax-section d-flex align-items-center justify-content-center text-white hero-bg"
        role="banner">
        <div class="position-absolute top-0 start-0 w-100 h-100 overlay-gradient" aria-hidden="true"></div>
        <div class="container position-relative z-index-1 text-center">
            <h1 class="display-1 fw-bold mb-4 hero-title reveal">Scopri l'Inesplorato</h1>
            <p class="lead fs-3 mb-5 fw-light reveal hero-description">
                Viaggi esclusivi per chi cerca non solo una vacanza, ma un'esperienza che cambia la vita.
            </p>
            <nav class="d-flex justify-content-center gap-3 reveal" aria-label="Azioni principali">
                <a href="{{ route('journeys.index') }}"
                    class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold text-primary shadow-lg hover-scale"
                    aria-label="Esplora i nostri viaggi">
                    I Nostri Viaggi
                </a>
                <a href="#about" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold hover-scale"
                    aria-label="Scopri chi siamo">
                    Chi Siamo
                </a>
            </nav>

            <div class="position-absolute bottom-0 start-0 w-100 pb-4 animate-bounce" aria-hidden="true">
                <i class="bi bi-chevron-down fs-1"></i>
            </div>
        </div>
    </header>

    <section id="about" class="section-padding bg-white overflow-hidden" aria-labelledby="about-heading">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0 reveal">
                    <h2 id="about-heading" class="display-4 fw-bold mb-4">Perché scegliere StartJourney?</h2>
                    <p class="lead text-muted mb-4">Non vendiamo semplici biglietti, costruiamo ricordi indelebili
                        curati in ogni minimo dettaglio. Da oltre 15 anni accompagniamo viaggiatori alla scoperta del
                        mondo.</p>

                    <article class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-start feature-card p-3 rounded-4 hover-bg-light">
                            <div class="icon-box-modern text-white fs-2 me-4 shadow-sm flex-shrink-0">
                                <i class="bi bi-shield-check" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="h4 fw-bold mb-1">Sicurezza Garantita</h3>
                                <p class="mb-0 text-muted">Assistenza 24/7 in tutto il mondo. Il nostro team è sempre
                                    raggiungibile per qualsiasi emergenza o necessità.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start feature-card p-3 rounded-4 hover-bg-light">
                            <div class="icon-box-modern text-white fs-2 me-4 shadow-sm flex-shrink-0">
                                <i class="bi bi-award" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="h4 fw-bold mb-1">Esperienza Premium</h3>
                                <p class="mb-0 text-muted">Accesso esclusivo alle migliori location, hotel 5 stelle e
                                    guide certificate. Ogni dettaglio è pensato per te.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start feature-card p-3 rounded-4 hover-bg-light">
                            <div class="icon-box-modern text-white fs-2 me-4 shadow-sm flex-shrink-0">
                                <i class="bi bi-heart-fill" aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="h4 fw-bold mb-1">Viaggi Sostenibili</h3>
                                <p class="mb-0 text-muted">Promuoviamo il turismo responsabile e la tutela ambientale. I
                                    nostri tour rispettano culture locali e natura.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-6 reveal">
                    <figure class="position-relative m-0">
                        <img src="{{ Storage::url('images/features.avif') }}"
                            alt="Viaggiatore felice con zaino che ammira il panorama"
                            class="img-fluid rounded-5 shadow-lg w-100 rotate-2" loading="lazy">
                        <aside class="position-absolute bottom-0 start-0 bg-white p-4 rounded-4 shadow-lg m-4 floating-review">
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-warning me-2" aria-label="Valutazione 5 stelle">
                                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                                </div>
                                <strong class="fw-bold">5.0/5</strong>
                            </div>
                            <blockquote class="small mb-0 text-muted">
                                "Un'organizzazione impeccabile per il viaggio della vita."
                            </blockquote>
                        </aside>
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="parallax-section py-5 mb-5 reveal stats-container stats-bg"
        aria-labelledby="stats-heading">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50" aria-hidden="true"></div>
        <div class="container position-relative z-index-1 py-5">
            <h2 id="stats-heading" class="visually-hidden">Statistiche azienda</h2>
            <div class="row g-4 text-center text-white">
                <div class="col-md-3">
                    <p class="display-3 fw-bold mb-0 counter-value" data-target="12000" data-suffix="+"
                        aria-live="polite">0</p>
                    <p class="text-white-50 text-uppercase letter-spacing-1">Clienti Felici</p>
                </div>
                <div class="col-md-3">
                    <p class="display-3 fw-bold mb-0 counter-value" data-target="500" data-suffix="+"
                        aria-live="polite">0</p>
                    <p class="text-white-50 text-uppercase letter-spacing-1">Destinazioni</p>
                </div>
                <div class="col-md-3">
                    <p class="display-3 fw-bold mb-0 counter-value" data-target="15" data-suffix="" aria-live="polite">0
                    </p>
                    <p class="text-white-50 text-uppercase letter-spacing-1">Anni di Esperienza</p>
                </div>
                <div class="col-md-3">
                    <p class="display-3 fw-bold mb-0 counter-value" data-target="24" data-suffix="/7"
                        aria-live="polite">0</p>
                    <p class="text-white-50 text-uppercase letter-spacing-1">Supporto Clienti</p>
                </div>
            </div>
        </div>
    </section>

    <aside class="parallax-section d-flex align-items-center py-5 divider-bg"
        aria-label="Citazione motivazionale">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25" aria-hidden="true"></div>
        <div class="container position-relative z-index-1 text-center text-white reveal">
            <h2 class="display-3 fw-bold mb-3">L'avventura ti aspetta</h2>
            <p class="fs-4 mb-4">Non aspettare che sia troppo tardi. Il mondo è un libro e chi non viaggia ne legge solo
                una pagina.</p>
        </div>
    </aside>

    <section class="section-padding bg-light" aria-labelledby="journeys-heading">
        <div class="container">
            <header class="text-center mb-5 reveal">
                <p class="text-primary text-uppercase letter-spacing-2 fw-bold mb-2">Destinazioni Scelte</p>
                <h2 id="journeys-heading" class="display-4 fw-bold">I Viaggi del Momento</h2>
                <p class="text-muted mt-3">Scopri le nostre proposte più richieste, selezionate dai nostri esperti</p>
            </header>

            <div class="row g-4">
                @foreach($journeys as $journey)
                    <article class="col-md-4 reveal">
                        <div class="card glass-card h-100 border-0 overflow-hidden rounded-4">
                            <div class="position-relative journey-card-img-container">
                                <img src="{{ $journey->image }}" class="w-100 h-100 object-fit-cover"
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
                            <div class="card-body p-4">
                                <p class="text-muted mb-4">{{ Str::limit($journey->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted d-block text-uppercase">A partire da</small>
                                        <strong
                                            class="h4 text-primary fw-bold mb-0">€{{ number_format($journey->price, 0, ',', '.') }}</strong>
                                    </div>
                                    <a href="{{ route('journeys.show', $journey) }}"
                                        class="btn btn-outline-primary rounded-circle p-3 d-flex align-items-center justify-content-center btn-circle-lg"
                                        aria-label="Scopri dettagli {{ $journey->title }}">
                                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <footer class="text-center mt-5 reveal">
                <a href="{{ route('journeys.index') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-pill hover-scale"
                    aria-label="Visualizza tutte le destinazioni">
                    Vedi tutte le destinazioni
                </a>
            </footer>
        </div>
    </section>

    <section class="section-padding bg-white" aria-labelledby="testimonials-heading">
        <div class="container">
            <header class="text-center mb-5 reveal">
                <p class="text-primary text-uppercase letter-spacing-2 fw-bold mb-2">Testimonianze</p>
                <h2 id="testimonials-heading" class="display-4 fw-bold">Cosa dicono i nostri viaggiatori</h2>
                <p class="text-muted mt-3">Oltre 12.000 clienti hanno scelto StartJourney per i loro viaggi da sogno</p>
            </header>
            <div class="row g-4">
                <article class="col-md-4 reveal">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-light rounded-4">
                        <div class="card-body">
                            <div class="text-warning mb-3" aria-label="Valutazione 5 stelle">
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                            </div>
                            <blockquote class="mb-4 fst-italic">
                                "Il viaggio in Giappone è stato perfetto. Organizzazione impeccabile e hotel stupendi.
                                Non vedo l'ora di prenotare il prossimo!"
                            </blockquote>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u=marco" class="rounded-circle me-3" width="50"
                                    height="50" alt="Foto profilo di Marco Rossi" loading="lazy">
                                <div>
                                    <h3 class="h6 fw-bold mb-0">Marco Rossi</h3>
                                    <small class="text-muted">Viaggiatore in Giappone</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-md-4 reveal">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-light rounded-4">
                        <div class="card-body">
                            <div class="text-warning mb-3" aria-label="Valutazione 5 stelle">
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                            </div>
                            <blockquote class="mb-4 fst-italic">
                                "Le Maldive sono state un sogno ad occhi aperti. Grazie a StartJourney abbiamo vissuto
                                una luna di miele da favola."
                            </blockquote>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u=giulia" class="rounded-circle me-3" width="50"
                                    height="50" alt="Foto profilo di Giulia Bianchi" loading="lazy">
                                <div>
                                    <h3 class="h6 fw-bold mb-0">Giulia Bianchi</h3>
                                    <small class="text-muted">Viaggiatrice alle Maldive</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-md-4 reveal">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-light rounded-4">
                        <div class="card-body">
                            <div class="text-warning mb-3" aria-label="Valutazione 5 stelle">
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                                <i class="bi bi-star-fill" aria-hidden="true"></i>
                            </div>
                            <blockquote class="mb-4 fst-italic">
                                "Safari in Kenya organizzato magistralmente. Abbiamo visto tutti i 'Big Five'!
                                Un'esperienza che consiglio a tutti."
                            </blockquote>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u=luca" class="rounded-circle me-3" width="50"
                                    height="50" alt="Foto profilo di Luca Verdi" loading="lazy">
                                <div>
                                    <h3 class="h6 fw-bold mb-0">Luca Verdi</h3>
                                    <small class="text-muted">Viaggiatore in Kenya</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="parallax-section d-flex align-items-center justify-content-center newsletter-bg"
        aria-labelledby="newsletter-heading">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-75 multiply-blend"
            aria-hidden="true"></div>
        <div class="container position-relative z-index-1 text-center text-white reveal">
            <h2 id="newsletter-heading" class="display-2 fw-bold mb-4">Crea ricordi indimenticabili</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="fs-4 opacity-75 mb-5">Iscriviti alla nostra newsletter per ricevere offerte esclusive,
                        ispirazioni di viaggio e consigli dai nostri esperti direttamente nella tua casella di posta.
                    </p>
                    <form class="row g-2 justify-content-center" aria-label="Form iscrizione newsletter">
                        <div class="col-8 col-md-6">
                            <label for="newsletter-email" class="visually-hidden">La tua email</label>
                            <input type="email" id="newsletter-email"
                                class="form-control form-control-lg rounded-pill px-4 border-0"
                                placeholder="La tua email..." required aria-required="true">
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="submit"
                                class="btn btn-warning btn-lg rounded-pill px-5 fw-bold w-100 shadow">Iscriviti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>