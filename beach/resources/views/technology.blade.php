<x-layout>
    @section('title', 'Tecnologia e Funzionamento')
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold text-primary mb-3"><i class="fas fa-layer-group me-3"></i>Architettura &
                    Tecnologia</h1>
                <p class="lead text-muted">Scopri le tecnologie che alimentano la piattaforma per una gestione balneare
                    sicura e scalabile.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3 text-primary"><i class="fab fa-laravel fa-3x"></i></div>
                    <h5 class="fw-bold">Laravel 10</h5>
                    <p class="text-muted small">Potente framework PHP per la logica backend e la sicurezza dei dati.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3 text-warning"><i class="fab fa-js-square fa-3x"></i></div>
                    <h5 class="fw-bold">Vanilla JS</h5>
                    <p class="text-muted small">Interazioni fluide e performance elevate senza framework pesanti.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3 text-info"><i class="fab fa-bootstrap fa-3x"></i></div>
                    <h5 class="fw-bold">Bootstrap 5</h5>
                    <p class="text-muted small">Design responsive ottimizzato per ogni dispositivo.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3 text-secondary"><i class="fas fa-database fa-3x"></i></div>
                    <h5 class="fw-bold">MySQL</h5>
                    <p class="text-muted small">Gestione affidabile e relazionale dei dati di prenotazione.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <h4 class="fw-bold mb-3 border-bottom pb-2">Backend</h4>
                <div class="card border-0 shadow-sm p-3 mb-3">
                    <h6><i class="fas fa-calendar-alt me-2 text-primary"></i>Gestione Date</h6>
                    <p class="small text-muted mb-0">Utilizzo di Carbon per calcoli precisi su soggiorni e
                        disponibilità.</p>
                </div>
                <div class="card border-0 shadow-sm p-3 mb-3">
                    <h6><i class="fas fa-shield-alt me-2 text-success"></i>Sicurezza</h6>
                    <p class="small text-muted mb-0">Protezione CSRF, validazione server-side e prevenzione SQL
                        Injection.</p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <h4 class="fw-bold mb-3 border-bottom pb-2">Frontend</h4>
                <div class="card border-0 shadow-sm p-3 mb-3">
                    <h6><i class="fas fa-hand-paper me-2 text-warning"></i>Interattività</h6>
                    <p class="small text-muted mb-0">Drag & Scroll personalizzato e auto-centering sul calendario.</p>
                </div>
                <div class="card border-0 shadow-sm p-3 mb-3">
                    <h6><i class="fas fa-print me-2 text-info"></i>Ottimizzazione Stampa</h6>
                    <p class="small text-muted mb-0">Media Queries dedicate per ricevute professionali su carta A4.</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>