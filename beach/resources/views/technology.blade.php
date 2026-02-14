<x-layout>
    @section('title', 'Tecnologia e Funzionamento')

    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold text-primary mb-3">
                    <i class="fas fa-layer-group me-3"></i>Architettura & Tecnologia
                </h1>
                <p class="lead text-muted">
                    Un'immersione profonda nel cuore pulsante della piattaforma. Scopri come le tecnologie più moderne
                    lavorano in sinergia per offrire un'esperienza di gestione balneare fluida, sicura e scalabile.
                </p>
            </div>
        </div>

        <!-- Section 1: Core Stack Overview -->
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-primary">
                        <i class="fab fa-laravel fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Laravel 10 Framework</h5>
                    <p class="text-muted small">
                        Il motore backend. Utilizziamo l'architettura MVC per separare logicamente i dati (Model),
                        l'interfaccia utente (View) e la logica di controllo (Controller), garantendo un codice pulito e
                        manutenibile.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-warning">
                        <i class="fab fa-js-square fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Vanilla JavaScript ES6+</h5>
                    <p class="text-muted small">
                        Performance pure. Abbiamo evitato framework frontend pesanti in favore di JavaScript nativo
                        ottimizzato
                        per gestire interazioni dinamiche come il "Drag & Scroll" del calendario senza latenza.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-info">
                        <i class="fab fa-bootstrap fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Bootstrap 5 & Custom CSS</h5>
                    <p class="text-muted small">
                        Interfaccia Responsive. Un sistema di griglie fluido combinato con variabili CSS custom (Theme
                        Variables)
                        per un design coerente su desktop, tablet e smartphone.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4">
                    <div class="mb-3 text-secondary">
                        <i class="fas fa-database fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">MySQL Relational DB</h5>
                    <p class="text-muted small">
                        Integrità dei Dati. Uno schema relazionale normalizzato gestisce le connessioni complesse tra
                        Ombrelloni, Prenotazioni e Clienti, assicurando che nessun dato vada perso o duplicato.
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-5 text-muted opacity-25">

        <!-- Section 2: Deep Dive into Architecture -->
        <div class="row">
            <!-- Backend Column -->
            <div class="col-lg-6 mb-5">
                <h3 class="fw-bold text-dark mb-4 border-bottom pb-2">
                    <i class="fas fa-cogs me-2 text-primary"></i>Backend: Il Motore Logico
                </h3>

                <div class="accordion" id="backendAccordion">

                    <!-- Controller Logic -->
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingController">
                            <button class="accordion-button fw-bold text-primary bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseController">
                                Controller & Gestione Flussi
                            </button>
                        </h2>
                        <div id="collapseController" class="accordion-collapse collapse show"
                            data-bs-parent="#backendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted mb-3">
                                    I Controller agiscono come "vigili urbani" del traffico dati. In particolare, il
                                    <code>PrenotazioneController</code> gestisce logiche complesse:
                                </p>
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item">
                                        <strong>Gestione Date (Carbon):</strong> Utilizziamo la libreria
                                        <code>Carbon</code> per manipolare le date, calcolare la durata dei soggiorni e
                                        filtrare le partenze odierne (<code>whereDate('data_fine', $today)</code>).
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Generazione Codici Univoci:</strong> Per le ricevute, generiamo codici
                                        alfanumerici casuali a 8 caratteri (<code>Str::random(8)</code>) per garantire
                                        l'unicità dei documenti.
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Calcolo Scorporo IVA:</strong> Logica matematica lato server per
                                        calcolare dinamicamente Imponibile e IVA (22%) partendo dal totale lordo.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Database & Eloquent -->
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingModels">
                            <button class="accordion-button collapsed fw-bold text-primary bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseModels">
                                Eloquent ORM & Relazioni
                            </button>
                        </h2>
                        <div id="collapseModels" class="accordion-collapse collapse" data-bs-parent="#backendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted mb-2">
                                    L'interazione con il database è astratta tramite Eloquent, che permette di scrivere
                                    query leggibili e sicure.
                                </p>
                                <div class="alert alert-secondary small mb-0">
                                    <strong>Eager Loading per Performance:</strong>
                                    <p class="mb-0 mt-1">
                                        Utilizziamo <code>with('ombrellone')</code> nelle query per risolvere il
                                        problema "N+1". Invece di fare una query per ogni prenotazione per trovare il
                                        nome dell'ombrellone, carichiamo tutti i dati necessari in una singola,
                                        efficiente query SQL ottimizzata.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security -->
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingSec">
                            <button class="accordion-button collapsed fw-bold text-primary bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseSec">
                                Sicurezza & Validazione
                            </button>
                        </h2>
                        <div id="collapseSec" class="accordion-collapse collapse" data-bs-parent="#backendAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled small">
                                    <li class="mb-2"><i class="fas fa-shield-alt text-success me-2"></i><strong>CSRF
                                            Protection:</strong> Ogni form è protetto da token anti-falsificazione.</li>
                                    <li class="mb-2"><i
                                            class="fas fa-check-double text-success me-2"></i><strong>Server-Side
                                            Validation:</strong> I dati in ingresso vengono validati rigorosamente (es.
                                        date, formati email, obbligatorietà campi) prima di toccare il database.</li>
                                    <li><i class="fas fa-lock text-success me-2"></i><strong>SQL Injection
                                            Prevention:</strong> L'uso di Eloquent e PDO binding previene
                                        automaticamente iniezioni malevole.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Frontend Column -->
            <div class="col-lg-6 mb-5">
                <h3 class="fw-bold text-dark mb-4 border-bottom pb-2">
                    <i class="fas fa-paint-brush me-2 text-warning"></i>Frontend: L'Esperienza Utente
                </h3>

                <div class="accordion" id="frontendAccordion">

                    <!-- Blade Engine -->
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingBlade">
                            <button class="accordion-button fw-bold text-warning bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseBlade">
                                Blade Template Engine
                            </button>
                        </h2>
                        <div id="collapseBlade" class="accordion-collapse collapse show"
                            data-bs-parent="#frontendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted">
                                    Blade non è solo HTML. È un motore potente che ci permette di costruire interfacce
                                    modulari.
                                </p>
                                <ul class="list-unstyled small">
                                    <li class="mb-2"><strong>Layout Inheritance:</strong> Una struttura base
                                        (<code>layout.blade.php</code>) definisce header, footer e stili comuni, che
                                        vengono estesi da ogni singola pagina.</li>
                                    <li class="mb-2"><strong>Components:</strong> Elementi riutilizzabili come la Navbar
                                        (<code>x-navbar</code>) mantengono il codice DRY (Don't Repeat Yourself).</li>
                                    <li><strong>Direttive Custom:</strong> Logica di visualizzazione pulita per mostrare
                                        alert condizionali (es. "Nessuna partenza oggi").</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive JS -->
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingJs">
                            <button class="accordion-button collapsed fw-bold text-warning bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseJs">
                                Interattività Avanzata (DOM & Events)
                            </button>
                        </h2>
                        <div id="collapseJs" class="accordion-collapse collapse" data-bs-parent="#frontendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted">
                                    Abbiamo implementato funzionalità "desktop-class" sul web:
                                </p>
                                <div class="card bg-light border-0 p-3 mb-2">
                                    <h6 class="fw-bold"><i class="fas fa-hand-paper me-2"></i>Drag & Scroll del
                                        Calendario</h6>
                                    <p class="small mb-0">
                                        Un modulo JavaScript custom ascolta gli eventi del mouse
                                        (<code>mousedown</code>, <code>mousemove</code>, <code>mouseup</code>) per
                                        calcolare il delta di movimento e tradurlo in scroll orizzontale della tabella,
                                        replicando l'esperienza fluida delle app native.
                                    </p>
                                </div>
                                <div class="card bg-light border-0 p-3">
                                    <h6 class="fw-bold"><i class="fas fa-compress-arrows-alt me-2"></i>Auto-Centering
                                    </h6>
                                    <p class="small mb-0">
                                        All'apertura della pagina, uno script calcola dinamicamente la posizione della
                                        colonna "Oggi" e scrolla automaticamente la vista per portarla al centro
                                        dell'attenzione dell'utente.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Print Styles -->
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded overflow-hidden">
                        <h2 class="accordion-header" id="headingPrint">
                            <button class="accordion-button collapsed fw-bold text-warning bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapsePrint">
                                Ottimizzazione Stampa (CSS Media Queries)
                            </button>
                        </h2>
                        <div id="collapsePrint" class="accordion-collapse collapse" data-bs-parent="#frontendAccordion">
                            <div class="accordion-body">
                                <p class="small text-muted">
                                    La pagina <strong>Ricevuta</strong> utilizza Media Queries specifiche
                                    (<code>@media print</code>) per trasformare una pagina web in un documento cartaceo
                                    professionale.
                                </p>
                                <ul class="list-unstyled small mb-0">
                                    <li><i class="fas fa-eye-slash text-muted me-2"></i>Nasconde elementi UI (bottoni,
                                        navbar, footer).</li>
                                    <li><i class="fas fa-border-none text-muted me-2"></i>Rimuove ombre ed effetti
                                        grafici non necessari.</li>
                                    <li><i class="fas fa-file-alt text-muted me-2"></i>Imposta margini e font leggibili
                                        su carta A4.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>