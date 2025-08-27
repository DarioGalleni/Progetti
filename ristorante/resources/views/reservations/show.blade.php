
<x-layout>
    <!-- Hero Section -->
    <section
        class="hero-section vh-50 d-flex align-items-center justify-content-center text-white text-center"
        style="background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),url('{{ asset('media/img/home-section.jpg') }}');
            background-size: cover;
            background-position: center;"
    >
        <div class="container">
            <h1 class="hero-title">Prenotazione Confermata</h1>
            <p class="hero-subtitle">Grazie per aver scelto Ristorante Buongusto!</p>
        </div>
    </section>

    <!-- Confirmation Details -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h3 class="mb-0">Dettagli della Prenotazione</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4>Email Prenotazione</h4>
                                <p>{{ $reservation->customer->email }}</p>
                                <p class="text-muted">Conserva questo codice. Ti servirà per eventuali modifiche.</p>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-1 fw-bold">Nome:</p>
                                    <p>{{ $reservation->customer->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 fw-bold">Telefono:</p>
                                    <p>{{ $reservation->customer->phone }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-1 fw-bold">Data:</p>
                                    <p>{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 fw-bold">Ora:</p>
                                    <p>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-1 fw-bold">Numero persone:</p>
                                    <p>{{ $reservation->people }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 fw-bold">Tavoli riservati:</p>
                                    <p>{{ $reservation->tables_required }}</p>
                                </div>
                            </div>

                            @if($reservation->notes)
                                <div class="mb-3">
                                    <p class="mb-1 fw-bold">Note:</p>
                                    <p>{{ $reservation->notes }}</p>
                                </div>
                            @endif

                            <hr>

                            <div class="text-center">
                                <p>Ti aspettiamo al Ristorante Buongusto!</p>
                                <p class="small text-muted">Per modificare o cancellare la prenotazione, contattaci allo +39 06 1234567 citando il tuo codice.</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary-custom">Torna alla Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>