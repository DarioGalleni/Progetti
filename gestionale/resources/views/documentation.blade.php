<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemma - Documentazione Tecnica</title>
    <!-- Bootstrap CSS (via CDN for standalone capability) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-bg: #f8f9fa;
            --card-bg: #ffffff;
            --text-main: #2d3748;
            --text-light: #718096;
            --highlight: #4f46e5;
            --highlight-light: #e0e7ff;
            --success: #10b981;
            --warning: #f59e0b;
        }

        body {
            background-color: var(--primary-bg);
            color: var(--text-main);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 2rem 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .tech-pill {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        .card-page {
            background: var(--card-bg);
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
        }

        .card-page:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header-custom {
            background: #fff;
            padding: 1.5rem;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            background: var(--highlight-light);
            color: var(--highlight);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .section-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            font-weight: 700;
            color: #1a202c;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--highlight);
            border-radius: 2px;
        }

        .detail-item {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .detail-item i {
            color: var(--highlight);
            margin-top: 4px;
        }

        .tech-tag {
            font-size: 0.75rem;
            padding: 0.2rem 0.6rem;
            background-color: #f3f4f6;
            color: #4b5563;
            border-radius: 4px;
            font-weight: 600;
        }

        .route-path {
            font-family: 'Fira Code', monospace;
            background: #2d3748;
            color: #63b3ed;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .feature-list {
            list-style: none;
            padding-left: 0;
        }

        .feature-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .feature-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--success);
            font-weight: bold;
        }

        /* Documentation Metadata block */
        .meta-block {
            background-color: #f8fafc;
            border-left: 4px solid var(--highlight);
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .collapse-trigger {
            cursor: pointer;
            user-select: none;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Gemma Project Documentation</h1>
            <p class="lead mb-4 opacity-75">Documentazione tecnica completa delle funzionalità, rotte e tecnologie.</p>

            <div class="d-flex justify-content-center flex-wrap gap-2">
                <span class="tech-pill"><i class="bi bi-layers-fill"></i> Laravel 12</span>
                <span class="tech-pill"><i class="bi bi-filetype-php"></i> PHP 8.2+</span>
                <span class="tech-pill"><i class="bi bi-bootstrap-fill"></i> Bootstrap 5.3</span>
                <span class="tech-pill"><i class="bi bi-wind"></i> TailwindCSS 4</span>
                <span class="tech-pill"><i class="bi bi-box-seam"></i> Vite</span>
                <span class="tech-pill"><i class="bi bi-database"></i> MySQL</span>
            </div>
        </div>
    </div>

    <div class="container pb-5">

        <!-- System Overview -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title">Panoramica del Sistema</h2>
                <div class="card card-page p-4">
                    <p class="lead text-muted">Avanzato sistema di gestione hotel (PMS) con funzionalità di calendario
                        interattivo, fatturazione elettronica, gestione gruppi e interfaccia mobile responsive.</p>
                    <div class="row g-4 mt-2">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-primary bg-opacity-10 text-primary"><i
                                        class="bi bi-calendar-event"></i></div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Planning</h6>
                                    <small class="text-muted">Drag & Drop</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-success bg-opacity-10 text-success"><i
                                        class="bi bi-cash-coin"></i></div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Billing</h6>
                                    <small class="text-muted">Invoicing & Expenses</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-warning bg-opacity-10 text-warning"><i class="bi bi-phone"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Mobile First</h6>
                                    <small class="text-muted">Responsive Views</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-info bg-opacity-10 text-info"><i class="bi bi-people"></i></div>
                                <div>
                                    <h6 class="mb-0 fw-bold">CRM</h6>
                                    <small class="text-muted">Customer Mgmt</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Core Views -->
        <h2 class="section-title">Core & Dashboard</h2>
        <div class="row g-4 mb-5">

            <!-- Welcome / Calendar -->
            <div class="col-lg-6">
                <div class="card card-page h-100">
                    <div class="card-header-custom">
                        <div class="icon-box"><i class="bi bi-calendar-week"></i></div>
                        <div>
                            <h5 class="mb-0 fw-bold">Planning Principale</h5>
                            <span class="route-path">/</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="meta-block">
                            <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">FILE</small><br>
                            <code>resources/views/welcome.blade.php</code><br>
                            <code>WelcomeController::index</code>
                        </div>
                        <p class="card-text">Dashboard principale che mostra la griglia di disponibilità delle camere.
                            Strumento centrale operativo per la reception.</p>

                        <h6 class="fw-bold mt-4 mb-2">Funzionalità Chiave</h6>
                        <ul class="feature-list">
                            <li>Visualizzazione matrice Camere/Giorni</li>
                            <li>Identificazione visiva provenienza (Booking.com vs Diretto)</li>
                            <li>Gestione eventi per Gruppi e Singoli</li>
                            <li>Link diretto al dettaglio prenotazione</li>
                            <li>Sticky headers per date e numeri camera</li>
                        </ul>

                        <h6 class="fw-bold mt-4 mb-2">Stack Tecnologico</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="tech-tag">Blade Loop Logic</span>
                            <span class="tech-tag">Custom Grid CSS</span>
                            <span class="tech-tag">Carbon Dates</span>
                            <span class="tech-tag">Config Rooms</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Calendar -->
            <div class="col-lg-6">
                <div class="card card-page h-100">
                    <div class="card-header-custom">
                        <div class="icon-box"><i class="bi bi-phone-landscape"></i></div>
                        <div>
                            <h5 class="mb-0 fw-bold">Mobile Calendar</h5>
                            <span class="route-path">/mobile-calendar</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="meta-block">
                            <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">FILE</small><br>
                            <code>WelcomeController::mobileIndex</code>
                        </div>
                        <p class="card-text">Versione ottimizzata per dispositivi touch e schermi piccoli. Focalizzata
                            sulla leggibilità rapida e operatività in movimento.</p>

                        <h6 class="fw-bold mt-4 mb-2">Funzionalità Chiave</h6>
                        <ul class="feature-list">
                            <li>Layout a colonna singola o compressa</li>
                            <li>Touch-friendly interactions</li>
                            <li>Filtro rapido "Oggi"</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Customers & Groups -->
        <h2 class="section-title">Clienti & Gruppi</h2>
        <div class="row g-4 mb-5">

            <!-- Customer CRUD -->
            <div class="col-lg-6">
                <div class="card card-page">
                    <div class="card-header-custom">
                        <div class="icon-box bg-info bg-opacity-10 text-info"><i class="bi bi-person-vcard"></i></div>
                        <div>
                            <h5 class="mb-0 fw-bold">Gestione Clienti</h5>
                            <span class="route-path">/customers/*</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="meta-block">
                            <code>CustomerController</code><br>
                            <small>Views: index, create, show, edit</small>
                        </div>
                        <p>Modulo completo per la gestione dell'anagrafica clienti e delle prenotazioni.</p>

                        <div class="accordion" id="accCustomers">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-light rounded-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#colCust1">
                                        <i class="bi bi-list-columns me-2"></i> Dettaglio Rotte
                                    </button>
                                </h2>
                                <div id="colCust1" class="accordion-collapse collapse" data-bs-parent="#accCustomers">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled small mb-0">
                                            <li class="mb-2"><code>GET /customers</code> - Lista filtrabile</li>
                                            <li class="mb-2"><code>POST /customers</code> - Creazione (Validazione
                                                Request)</li>
                                            <li class="mb-2"><code>GET /{id}</code> - Scheda dettaglio (Show)</li>
                                            <li><code>PUT /{id}</code> - Aggiornamento dati</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Groups -->
            <div class="col-lg-6">
                <div class="card card-page">
                    <div class="card-header-custom">
                        <div class="icon-box bg-purple bg-opacity-10 text-purple" style="color: #6f42c1;"><i
                                class="bi bi-people-fill"></i></div>
                        <div>
                            <h5 class="mb-0 fw-bold">Gestione Gruppi</h5>
                            <span class="route-path">/groups/*</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="meta-block">
                            <code>GroupController</code>
                        </div>
                        <p>Gestione aggregata di prenotazioni multiple sotto un'unica entità (Capogruppo/Agenzia).</p>
                        <ul class="feature-list">
                            <li>Creazione rapida multi-stanza</li>
                            <li>Fatturazione unificata</li>
                            <li>List view dedicata</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Billing -->
        <h2 class="section-title">Fatturazione & Extra</h2>
        <div class="row g-4 mb-5">

            <div class="col-md-4">
                <div class="card card-page h-100">
                    <div class="card-body text-center">
                        <div class="icon-box mx-auto mb-3 bg-success bg-opacity-10 text-success"><i
                                class="bi bi-cart-plus"></i></div>
                        <h5 class="fw-bold">Gestione Extra</h5>
                        <p class="small text-muted mb-3"><code>/billing/{id}/expenses</code></p>
                        <p class="small">Interfaccia per aggiungere consumazioni (Bar, Frigobar, Servizi) al conto della
                            camera.</p>
                        <span class="tech-tag">AJAX Store</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-page h-100">
                    <div class="card-body text-center">
                        <div class="icon-box mx-auto mb-3 bg-dark bg-opacity-10 text-dark"><i class="bi bi-printer"></i>
                        </div>
                        <h5 class="fw-bold">Stampa Conto</h5>
                        <p class="small text-muted mb-3"><code>/billing/{id}/bill/print</code></p>
                        <p class="small">Generazione foglio di riepilogo per il cliente. CSS ottimizzato per stampa A4
                            con rimozione header/footer browser.</p>
                        <span class="tech-tag">Media API: Print</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-page h-100">
                    <div class="card-body text-center">
                        <div class="icon-box mx-auto mb-3 bg-secondary bg-opacity-10 text-secondary"><i
                                class="bi bi-receipt"></i></div>
                        <h5 class="fw-bold">Ricevuta</h5>
                        <p class="small text-muted mb-3"><code>/billing/{id}/receipt</code></p>
                        <p class="small">Vista semplificata per ricevuta fiscale o non fiscale veloce.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Services -->
        <h2 class="section-title">Servizi Operativi</h2>
        <div class="row g-4 mb-5">

            <!-- Housekeeping -->
            <div class="col-md-6">
                <div class="card card-page">
                    <div class="d-flex p-3 align-items-center">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning me-3"><i class="bi bi-broom"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Pulizie (Housekeeping)</h6>
                            <code class="small text-muted">/cleaning</code>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <p class="small mb-0">Gestione stato camere (Sporca, Pulita, In Arrivo). Genera report
                            stampabile per le cameriere ai piani.</p>
                        <div class="mt-2 text-end">
                            <span class="badge bg-secondary">Stampa Dedicata</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Restaurant -->
            <div class="col-md-6">
                <div class="card card-page">
                    <div class="d-flex p-3 align-items-center">
                        <div class="icon-box bg-danger bg-opacity-10 text-danger me-3"><i class="bi bi-cup-hot"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Ristorante</h6>
                            <code class="small text-muted">/restaurant</code>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <p class="small mb-0">Lista ospiti con trattamento (HB/FB) per la cucina. Report intolleranze e
                            note alimentari.</p>
                    </div>
                </div>
            </div>

            <!-- Reception Lists -->
            <div class="col-md-6">
                <div class="card card-page">
                    <div class="d-flex p-3 align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3"><i
                                class="bi bi-box-arrow-in-right"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Arrivi & Partenze</h6>
                            <code class="small text-muted">/arrivals</code>, <code
                                class="small text-muted">/departures</code>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <p class="small mb-0">Liste operative giornaliere per Check-in e Check-out rapidi.</p>
                    </div>
                </div>
            </div>

            <!-- System -->
            <div class="col-md-6">
                <div class="card card-page">
                    <div class="d-flex p-3 align-items-center">
                        <div class="icon-box bg-dark bg-opacity-10 text-dark me-3"><i class="bi bi-hdd-network"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Sistema & Backup</h6>
                            <code class="small text-muted">/system/*</code>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <p class="small mb-0">Strumenti di manutenzione e sicurezza dati.</p>
                        <ul class="feature-list mt-2">
                            <li><strong>Backup Manuale:</strong> Trigger su richiesta.</li>
                            <li><strong>Backup Automatico:</strong> <span class="tech-tag">AutomaticBackupObserver</span> osserva le modifiche ai modelli critici.</li>
                            <li><strong>Pulizia Cache:</strong> Reset completo (Artisan calls).</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted border-top mt-5" style="background: white;">
        <small>&copy; {{ date('Y') }} Gemma Gestionale - Documentazione generata automaticamente.</small>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>