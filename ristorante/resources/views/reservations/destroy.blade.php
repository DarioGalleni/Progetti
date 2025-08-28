<x-layout>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                            <h2 class="mt-3 text-danger">Prenotazione Cancellata</h2>
                            <p class="text-muted">La tua prenotazione è stata cancellata con successo</p>
                        </div>
                        
                        <div class="bg-light p-4 rounded mb-4">
                            <h4 class="mb-3">Dettagli della prenotazione cancellata</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <strong>Nome:</strong><br>
                                    {{ $reservation->name }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Data:</strong><br>
                                    {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Orario:</strong><br>
                                    {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Persone:</strong><br>
                                    {{ $reservation->people }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle me-2"></i>Cosa succede ora?</h5>
                            <p class="mb-0">
                                La tua prenotazione è stata definitivamente cancellata. Il tavolo è ora disponibile per altri clienti.
                                Se desideri fare una nuova prenotazione, puoi utilizzare il modulo sul nostro sito web.
                            </p>
                        </div>
                        
                        <div class="bg-dark text-white p-4 rounded mb-4">
                            <h5>Contatti del Ristorante</h5>
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
                        
                        <div class="text-center">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-home me-2"></i>Torna al Sito
                            </a>
                            <a href="{{ route('home') }}#reservation" class="btn btn-success btn-lg">
                                <i class="fas fa-plus me-2"></i>Nuova Prenotazione
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>