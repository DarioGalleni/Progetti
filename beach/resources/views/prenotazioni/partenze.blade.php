<x-layout>
    @section('title', 'Partenze Odierne')

    <div class="container mt-4">
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-center p-3">
                <i class="fas fa-suitcase-rolling hero-icon me-4 text-primary" style="font-size: 2.5rem;"></i>
                <div>
                    <h2 class="mb-1 text-dark fw-bold">Partenze di Oggi</h2>
                    <p class="text-muted mb-0 fs-5">{{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Torna al Calendario
            </a>
        </div>

        @if($prenotazioni->isEmpty())
            <div class="alert alert-info text-center shadow-sm p-5">
                <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                <h4>Nessuna partenza prevista per oggi.</h4>
                <p class="text-muted">Tutti gli ospiti rimangono ancora un po'!</p>
            </div>
        @else
            {{-- Desktop View (MD+) --}}
            <div class="d-none d-md-block">
                <div class="card beach-card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-secondary text-uppercase small fw-bold">Ombrellone</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold">Cliente</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold">Periodo</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold">Contatti</th>
                                        <th class="py-3 text-center text-secondary text-uppercase small fw-bold">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prenotazioni as $prenotazione)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                        style="width: 45px; height: 45px;">
                                                        <i class="fas fa-umbrella-beach"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0 text-dark fw-bold">
                                                            {{ strtoupper($prenotazione->ombrellone->fila) }} -
                                                            {{ $prenotazione->ombrellone->numero }}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $prenotazione->nome }}
                                                    {{ $prenotazione->cognome }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column small">
                                                    <span class="text-success"><i class="fas fa-arrow-right me-1"></i> Dal:
                                                        {{ \Carbon\Carbon::parse($prenotazione->data_inizio)->format('d/m/Y') }}</span>
                                                    <span class="text-danger"><i class="fas fa-arrow-left me-1"></i> Al:
                                                        {{ \Carbon\Carbon::parse($prenotazione->data_fine)->format('d/m/Y') }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($prenotazione->telefono)
                                                    <div class="small mb-1"><i class="fas fa-phone me-2 text-muted"
                                                    style="width: 20px;"></i>{{ $prenotazione->telefono }}</div>
                                                @endif
                                                @if($prenotazione->email)
                                                    <div class="small"><i class="fas fa-envelope me-2 text-muted"
                                                    style="width: 20px;"></i><a href="mailto:{{ $prenotazione->email }}">{{ $prenotazione->email }}</a></div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('prenotazioni.ricevuta', $prenotazione->id) }}" target="_blank"
                                                    class="btn btn-sm btn-primary shadow-sm">
                                                    <i class="fas fa-print me-1"></i> Stampa Ricevuta
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-end text-muted small">
                    Totale partenze: {{ $prenotazioni->count() }}
                </div>
            </div>

            {{-- Mobile View (<MD) --}}
            <div class="d-block d-md-none">
                <div class="d-flex justify-content-between align-items-center mb-3">
                     <span class="text-muted small">Totale partenze: {{ $prenotazioni->count() }}</span>
                </div>
                
                @foreach($prenotazioni as $prenotazione)
                <div class="card beach-card border-0 shadow-sm mb-3">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; min-width: 45px;">
                                <i class="fas fa-umbrella-beach fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fw-bold">{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</h5>
                                <div class="text-muted small">
                                    <span class="badge bg-light text-dark border me-1">
                                        {{ strtoupper($prenotazione->ombrellone->fila) }} - {{ $prenotazione->ombrellone->numero }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light rounded p-2 mb-3 small">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted"><i class="fas fa-calendar-check me-2"></i>Dal:</span>
                                <span class="fw-medium text-success">{{ \Carbon\Carbon::parse($prenotazione->data_inizio)->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted"><i class="fas fa-calendar-times me-2"></i>Al:</span>
                                <span class="fw-medium text-danger">{{ \Carbon\Carbon::parse($prenotazione->data_fine)->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        @if($prenotazione->telefono || $prenotazione->email)
                        <div class="mb-3 small">
                            @if($prenotazione->telefono)
                                <div class="mb-1 d-flex align-items-center">
                                    <i class="fas fa-phone me-3 text-muted" style="width: 16px;"></i>
                                    <a href="tel:{{ $prenotazione->telefono }}">{{ $prenotazione->telefono }}</a>
                                </div>
                                <div class="mb-1 d-flex align-items-center">
                                    <i class="fab fa-whatsapp me-3 text-muted" style="width: 16px;"></i>
                                    <a href="https://wa.me/39{{ str_replace(' ', '', $prenotazione->telefono) }}" target="_blank">
                                        Invia messaggio
                                    </a>
                                </div>
                            @endif
                            @if($prenotazione->email)
                                <div class="small"><i class="fas fa-envelope me-2 text-muted"
                                style="width: 20px;"></i><a href="mailto:{{ $prenotazione->email }}">{{ $prenotazione->email }}</a></div>
                            @endif
                        </div>
                        @endif

                        <div class="d-grid">
                            <a href="{{ route('prenotazioni.ricevuta', $prenotazione->id) }}" target="_blank" class="btn btn-outline-primary shadow-sm btn-sm">
                                <i class="fas fa-print me-2"></i>Stampa Ricevuta
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>