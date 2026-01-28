<x-layout title="Informazioni Tecniche - StartJourney">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white p-5 text-center position-relative overflow-hidden">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10"></div>
                        <div class="position-relative z-index-1">
                            <i class="bi bi-code-square fs-1 mb-3 d-block"></i>
                            <h1 class="display-4 fw-bold mb-2">Ambiente di Test </h1>
                            <p class="lead opacity-90 mb-0">Scopri come funziona StartJourney sotto il cofano.</p>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <!-- Intro Section -->
                        <div class="mb-5 text-center">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> DEMO MODE
                            </span>
                            <h2 class="h3 fw-bold mb-3">Benvenuto nella versione dimostrativa</h2>
                            <p class="text-muted fs-5">
                                Questa è un progetto <strong>in fase di sviluppo</strong>. Sentiti libero di esplorare tutte le
                                funzionalità CRUD (Create, Read, Update, Delete).
                                Puoi aggiungere nuovi viaggi, modificare quelli esistenti o eliminarli per testare la
                                robustezza del sistema.
                                <br><br>
                                <em>Nota: Le funzionalità di amministrazione, presente nel link " Gestisci " sulla navbar sono state temporaneamente rese pubbliche
                                per scopi dimostrativi.</em>
                            </p>
                        </div>

                        <hr class="my-5 opacity-10">

                        <!-- Tech Stack Grid -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="p-4 bg-light rounded-4 h-100 border border-light shadow-sm">
                                    <h3 class="h4 fw-bold text-primary mb-4 d-flex align-items-center">
                                        <i class="bi bi-server me-3 fs-3"></i> Backend Architecture
                                    </h3>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="bi bi-check-circle-fill text-success mt-1 me-3"></i>
                                            <div>
                                                <strong>Laravel 10+</strong>
                                                <p class="small text-muted mb-0">Framework PHP robusto e moderno per la
                                                    gestione della logica applicativa.</p>
                                            </div>
                                        </li>
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="bi bi-hdd-network-fill text-success mt-1 me-3"></i>
                                            <div>
                                                <strong>Eloquent ORM</strong>
                                                <p class="small text-muted mb-0">Interazioni con il database MySQL
                                                    eleganti ed efficienti.</p>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="bi bi-cloud-arrow-up-fill text-success mt-1 me-3"></i>
                                            <div>
                                                <strong>Cloud Storage (R2/S3)</strong>
                                                <p class="small text-muted mb-0">Gestione asincrona dei media via Facade
                                                    Storage. Le immagini vengono caricate su bucket remoti per
                                                    performance ottimali.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-4 bg-light rounded-4 h-100 border border-light shadow-sm">
                                    <h3 class="h4 fw-bold text-info mb-4 d-flex align-items-center">
                                        <i class="bi bi-laptop me-3 fs-3"></i> Frontend UI/UX
                                    </h3>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="bi bi-check-circle-fill text-success mt-1 me-3"></i>
                                            <div>
                                                <strong>Blade Template Engine</strong>
                                                <p class="small text-muted mb-0">Sistema di templating potente per viste
                                                    dinamiche e componenti (x-layout).</p>
                                            </div>
                                        </li>
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="bi bi-bootstrap-fill text-success mt-1 me-3"></i>
                                            <div>
                                                <strong>Bootstrap 5 & Custom CSS</strong>
                                                <p class="small text-muted mb-0">Design responsivo arricchito da
                                                    variabili CSS personalizzate e utility classes.</p>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="bi bi-magic text-success mt-1 me-3"></i>
                                            <div>
                                                <strong>Glassmorphism & Animations</strong>
                                                <p class="small text-muted mb-0">Scroll Reveal effects e UI moderna per
                                                    un'esperienza utente premium.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Logic & Controllers Deep Dive -->
                        <div class="bg-dark text-white p-5 rounded-4 position-relative overflow-hidden mb-5">
                            <div class="position-absolute top-0 end-0 p-4 opacity-25">
                                <i class="bi bi-gear-wide-connected display-1"></i>
                            </div>
                            <h3 class="h3 fw-bold mb-4">Logica Applicativa</h3>

                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <h4 class="h5 text-warning mb-3">JourneyController (Resource)</h4>
                                    <p class="opacity-75 small line-height-lg">
                                        Il cuore dell'applicazione. Gestisce l'intero ciclo di vita dei pacchetti
                                        viaggio seguendo lo standard REST:
                                        <br><code>index</code>: Lista paginata/filtrata dei viaggi.
                                        <br><code>show</code>: Dettaglio singolo viaggio.
                                        <br><code>create/store</code>: Validazione form e upload immagini su Cloud.
                                        <br><code>edit/update</code>: Gestione modifiche e sostituzione immagini.
                                        <br><code>destroy</code>: Eliminazione sicura dal DB e rimozione file remoti.
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="h5 text-warning mb-3">JavaScript & Interattività</h4>
                                    <p class="opacity-75 small line-height-lg">
                                        L'esperienza utente è potenziata da JavaScript vanilla (senza jQuery) per
                                        massimizzare le performance:
                                        <br>• Intersection Observer API per le animazioni "on-scroll".
                                        <br>• Parallax effects calcolati dinamicamente.
                                        <br>• Gestione modali e feedback utente immediati.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('home') }}"
                                class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow hover-scale">
                                <i class="bi bi-arrow-left me-2"></i> Torna alla Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>