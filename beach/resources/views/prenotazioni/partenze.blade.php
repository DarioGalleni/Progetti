<x-layout>
    @section('title', 'Partenze')

    <div class="container mt-4">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <i class="fas fa-suitcase-rolling hero-icon me-4 text-primary" style="font-size: 2.5rem;"></i>
                    <div>
                        <h2 class="mb-1 text-dark fw-bold">Partenze</h2>
                        <p class="text-muted mb-0 fs-5">{{ $date->translatedFormat('l d F Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <form action="{{ route('prenotazioni.partenze') }}" method="GET" class="d-flex justify-content-md-end">
                    <div class="input-group shadow-sm" style="max-width: 300px;">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-calendar-alt text-primary"></i></span>
                        <input type="date" name="date" class="form-control border-start-0 ps-0" value="{{ $date->format('Y-m-d') }}" onchange="this.form.submit()">
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Calendario</a>
        </div>

        @if($prenotazioni->isEmpty())
            <div class="alert alert-info text-center shadow-sm p-5">
                <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                <h4>Nessuna partenza prevista.</h4>
            </div>
        @else
            {{-- Desktop View --}}
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
                                    @foreach($prenotazioni as $p)
                                        @php $checkout = \Carbon\Carbon::parse($p->data_fine)->addDay(); @endphp
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                                        <i class="fas fa-umbrella-beach"></i>
                                                    </div>
                                                    <h5 class="mb-0 text-dark fw-bold">{{ strtoupper($p->ombrellone->fila) }} - {{ $p->ombrellone->numero }}</h5>
                                                </div>
                                            </td>
                                            <td><div class="fw-bold text-dark">{{ $p->nome }} {{ $p->cognome }}</div></td>
                                            <td>
                                                <div class="d-flex flex-column small">
                                                    <span class="text-success">Dal: {{ \Carbon\Carbon::parse($p->data_inizio)->format('d/m/Y') }}</span>
                                                    <span class="text-danger">Al: {{ $checkout->format('d/m/Y') }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($p->telefono) <div class="small"><i class="fas fa-phone me-2 text-muted"></i>{{ $p->telefono }}</div> @endif
                                                @if($p->email) <div class="small"><i class="fas fa-envelope me-2 text-muted"></i>{{ $p->email }}</div> @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('prenotazioni.ricevuta', $p->id) }}" target="_blank" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-print me-1"></i> Ricevuta</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile View --}}
            <div class="d-block d-md-none">
                @foreach($prenotazioni as $p)
                    @php $checkout = \Carbon\Carbon::parse($p->data_fine)->addDay(); @endphp
                    <div class="card beach-card border-0 shadow-sm mb-3">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-umbrella-beach fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-0 fw-bold">{{ $p->nome }} {{ $p->cognome }}</h5>
                                    <span class="badge bg-light text-dark border">{{ strtoupper($p->ombrellone->fila) }} - {{ $p->ombrellone->numero }}</span>
                                </div>
                            </div>
                            <div class="bg-light rounded p-2 mb-3 small">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Dal:</span>
                                    <span class="text-success fw-bold">{{ \Carbon\Carbon::parse($p->data_inizio)->format('d/m/Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Al:</span>
                                    <span class="text-danger fw-bold">{{ $checkout->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            @if($p->telefono || $p->email)
                                <div class="mb-3 small">
                                    @if($p->telefono)
                                        <div class="mb-1"><i class="fas fa-phone me-3 text-muted"></i><a href="tel:{{ $p->telefono }}">{{ $p->telefono }}</a></div>
                                        <div class="mb-1"><i class="fab fa-whatsapp me-3 text-muted"></i><a href="https://wa.me/39{{ str_replace(' ', '', $p->telefono) }}" target="_blank">WhatsApp</a></div>
                                    @endif
                                    @if($p->email)
                                        <div><i class="fas fa-envelope me-3 text-muted"></i><a href="mailto:{{ $p->email }}">{{ $p->email }}</a></div>
                                    @endif
                                </div>
                            @endif
                            <div class="d-grid shadow-sm">
                                <a href="{{ route('prenotazioni.ricevuta', $p->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">Stampa Ricevuta</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>