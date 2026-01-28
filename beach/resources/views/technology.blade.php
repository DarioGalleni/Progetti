<x-layout>
    @section('title', 'Tecnologia e Funzionamento')

    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold text-primary mb-3">
                    <i class="fas fa-layer-group me-3"></i>Architettura & Tecnologia
                </h1>
                <p class="lead text-muted">
                    Un'analisi approfondita dello stack tecnologico, delle scelte architetturali e del funzionamento
                    interno della piattaforma.
                </p>
            </div>
        </div>

        <!-- Section 1: Core Stack -->
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-primary">
                        <i class="fab fa-laravel fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Laravel 10+</h5>
                    <p class="text-muted small">
                        Backend robusto basato sull'ultima versione del framework PHP più diffuso. Utilizza le
                        funzionalità più recenti per sicurezza e performance.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-warning">
                        <i class="fab fa-js fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Vanilla JS</h5>
                    <p class="text-muted small">
                        Logica frontend leggera e veloce senza dipendenze pesanti. Manipolazione del DOM ottimizzata per
                        interazioni fluide.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-info">
                        <i class="fab fa-bootstrap fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Bootstrap 5</h5>
                    <p class="text-muted small">
                        Design responsive e moderno. Utilizzo di griglie flessibili, componenti pre-stilizzati e utility
                        classes per uno sviluppo rapido.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-secondary">
                        <i class="fas fa-database fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">MySQL</h5>
                    <p class="text-muted small">
                        Database relazionale solido. Gestione complessa di prenotazioni, clienti e ombrelloni con
                        integrità referenziale.
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <!-- Section 2: Detailed Breakdown -->
        <div class="row">
            <!-- Backend Column -->
            <div class="col-lg-6 mb-5">
                <h3 class="fw-bold text-dark mb-4 border-bottom pb-2">
                    <i class="fas fa-server me-2 text-primary"></i>Backend & Struttura
                </h3>

                <div class="accordion" id="backendAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingController">
                            <button class="accordion-button fw-bold text-primary bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseController">
                                Controller & Logica
                            </button>
                        </h2>
                        <div id="collapseController" class="accordion-collapse collapse show"
                            data-bs-parent="#backendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted mb-2">
                                    I controller gestiscono il flusso dei dati tra Model e View. Esempi chiave:
                                </p>
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <code>PrenotazioneController</code>
                                        <span class="badge bg-primary rounded-pill">CRUD</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <code>OmbrelloneController</code>
                                        <span class="badge bg-info rounded-pill">Display</span>
                                    </li>
                                    <li class="list-group-item">
                                        Gestione logica complessa come il calcolo dei prezzi e la validazione delle
                                        date.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingModels">
                            <button class="accordion-button collapsed fw-bold text-primary bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseModels">
                                Modelli (Models) & Eloquent
                            </button>
                        </h2>
                        <div id="collapseModels" class="accordion-collapse collapse" data-bs-parent="#backendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted mb-2">
                                    L'ORM Eloquent semplifica l'interazione con il database.
                                </p>
                                <div class="alert alert-secondary small mb-0">
                                    <strong>Relazioni definite:</strong>
                                    <ul class="mb-0 mt-1">
                                        <li>Un <code>Ombrellone</code> ha molte <code>Prenotazioni</code>.</li>
                                        <li>Una <code>Prenotazione</code> appartiene a un <code>Ombrellone</code>.</li>
                                        <li>I modelli includono Casts, Mutators e Scopes per query efficienti.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingDb">
                            <button class="accordion-button collapsed fw-bold text-primary bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseDb">
                                Database & Migrations
                            </button>
                        </h2>
                        <div id="collapseDb" class="accordion-collapse collapse" data-bs-parent="#backendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted">
                                    Lo schema del database è versionato tramite <strong>Migration</strong> file,
                                    garantendo riproducibilità e consistenza.
                                </p>
                                <pre class="bg-dark text-light p-3 rounded small mb-0"><code>Schema::create('prenotazioni', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ombrellone_id')->constrained();
    $table->date('data_inizio');
    $table->date('data_fine');
    $table->timestamps();
});</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Frontend Column -->
            <div class="col-lg-6 mb-5">
                <h3 class="fw-bold text-dark mb-4 border-bottom pb-2">
                    <i class="fas fa-laptop-code me-2 text-warning"></i>Frontend & UI/UX
                </h3>

                <div class="accordion" id="frontendAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingBlade">
                            <button class="accordion-button fw-bold text-warning bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseBlade">
                                Blade Templating
                            </button>
                        </h2>
                        <div id="collapseBlade" class="accordion-collapse collapse show"
                            data-bs-parent="#frontendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted">
                                    Il motore di template Blade permette di creare viste dinamiche e modulari.
                                </p>
                                <ul class="list-unstyled small">
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>Components:</strong>
                                        Riutilizzo di codice UI (es. <code>&lt;x-layout&gt;</code>,
                                        <code>&lt;x-navbar&gt;</code>).</li>
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>Directives:</strong>
                                        Logica condizionale pulita (<code>@@if</code>, <code>@@foreach</code>,
                                        <code>@@auth</code>).</li>
                                    <li><i class="fas fa-check text-success me-2"></i><strong>Inheritance:</strong>
                                        Layout master per consistenza grafica.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingJs">
                            <button class="accordion-button collapsed fw-bold text-warning bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseJs">
                                JavaScript & Interattività
                            </button>
                        </h2>
                        <div id="collapseJs" class="accordion-collapse collapse" data-bs-parent="#frontendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted">
                                    Funzionalità avanzate implementate con JavaScript puro.
                                </p>
                                <div class="card bg-light border-0 p-3 mb-2">
                                    <h6 class="fw-bold">Feature "Drag & Scroll"</h6>
                                    <p class="small mb-0">
                                        Il calendario supporta lo scorrimento trascinando il mouse, simile a Google
                                        Maps, migliorando l'usabilità su desktop.
                                    </p>
                                </div>
                                <div class="card bg-light border-0 p-3">
                                    <h6 class="fw-bold">Scorciatoie Tastiera</h6>
                                    <p class="small mb-0">
                                        Implementazione di listener per eventi <code>keydown</code> e <code>click</code>
                                        combinati (es. Ctrl+Click) per azioni rapide.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingCss">
                            <button class="accordion-button collapsed fw-bold text-warning bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseCss">
                                CSS & Design System
                            </button>
                        </h2>
                        <div id="collapseCss" class="accordion-collapse collapse" data-bs-parent="#frontendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted">
                                    Stile curato nei dettagli utilizzando Bootstrap esteso con CSS personalizzato.
                                </p>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><span class="badge bg-secondary">Responsive
                                            Design</span></li>
                                    <li class="list-inline-item"><span class="badge bg-secondary">Flexbox</span></li>
                                    <li class="list-inline-item"><span class="badge bg-secondary">Grid System</span>
                                    </li>
                                    <li class="list-inline-item"><span class="badge bg-secondary">Animations</span></li>
                                </ul>
                                <p class="small mt-2">
                                    Design system coerente con palette colori marina (Beach Theme), ombreggiature "soft"
                                    e border-radius moderni.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>