<x-layout>
    <section class="hero-section vh-25 d-flex align-items-center justify-content-center text-white text-center"
             style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('media/img/home-section.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="hero-title">Grazie, {{ $reservation->name }}</h1>
        </div>
    </section>

    <div class="container mt-2 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <!-- Icona di successo -->
                        <div class="text-center mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                            <h2 class="mt-3 text-success">Prenotazione Confermata!</h2>
                        </div>

                        <!-- Dettagli prenotazione -->
                        <div class="bg-light p-4 rounded mb-4">
                            <h4 class="mb-3">Dettagli della tua prenotazione</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <strong>Nome:</strong><br>
                                    {{ $reservation->name }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Email:</strong><br>
                                    {{ $reservation->email }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Telefono:</strong><br>
                                    {{ $reservation->phone }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Numero persone:</strong><br>
                                    {{ $reservation->people }} {{ $reservation->people == 1 ? 'persona' : 'persone' }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Data:</strong><br>
                                    {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Orario:</strong><br>
                                    {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}
                                    @if($reservation->isLunchSlot())
                                        <span class="badge bg-primary ms-2">Pranzo</span>
                                    @else
                                        <span class="badge bg-warning ms-2">Cena</span>
                                    @endif
                                </div>

                                @if($reservation->notes)
                                    <div class="col-12 mb-3">
                                        <strong>Note:</strong><br>
                                        {{ $reservation->notes }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Informazione importante sull'email -->
                        <div class="alert alert-info mb-4">
                            <h5><i class="fas fa-info-circle me-2"></i>Informazione Importante</h5>
                            <p class="mb-2">
                                <strong>
                                    L'indirizzo email fornito sarà utilizzato per consentire modifiche autonome alla prenotazione in un secondo momento.
                                </strong>
                            </p>
                        </div>

                        <!-- Informazioni del Ristorante -->
                        <div class="bg-dark text-white p-4 rounded mb-4">
                            <h5>Informazioni del Ristorante</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Piazza Augusto Albini, 10, 00154 Roma</p>
                                    <p class="mb-2"><i class="fas fa-phone me-2"></i>+39 06 1234567</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><i class="fas fa-envelope me-2"></i>info@ristorantebuongusto.it</p>
                                    <p class="mb-2"><i class="fas fa-clock me-2"></i>Mar-Dom: 12:00-15:00, 19:00-23:00</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pulsanti azione -->
                        <div class="text-center">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-home me-2"></i>Torna al Sito
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
