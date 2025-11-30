<x-layout>
    @section('title', 'Dettaglio Prenotazione')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                {{-- Pulsante per tornare indietro --}}
                <div class="mb-3">
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Torna al Calendario
                    </a>
                </div>

                <div class="card beach-card">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="text-sea mb-0">
                                Prenotazione #{{ $prenotazione->id }}
                            </h2>
                            <span class="badge bg-primary fs-6">
                                Ombrellone {{ strtoupper($prenotazione->ombrellone->fila) }} - {{ $prenotazione->ombrellone->numero }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            
                            {{-- Sezione Cliente --}}
                            <div class="col-md-6">
                                <h5 class="text-secondary border-bottom pb-2 mb-3">Dati Cliente</h5>
                                <p class="mb-1"><strong>Nome:</strong> {{ $prenotazione->nome }} {{ $prenotazione->cognome }}</p>
                                <p class="mb-1">
                                    <strong>Email:</strong> 
                                    @if($prenotazione->email)
                                        <a href="mailto:{{ $prenotazione->email }}">{{ $prenotazione->email }}</a>
                                    @else
                                        <span class="text-muted fst-italic">Non specificata</span>
                                    @endif
                                </p>
                                <p class="mb-1">
                                    <strong>Telefono:</strong>
                                    @if($prenotazione->telefono)
                                        <a href="tel:{{ $prenotazione->telefono }}" class="text-decoration-none">
                                            {{ $prenotazione->telefono }}
                                        </a>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $prenotazione->telefono) }}" target="_blank" class="ms-2 text-success">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    @else
                                        <span class="text-muted fst-italic">Non specificato</span>
                                    @endif
                                </p>
                            </div>

                            {{-- Sezione Soggiorno --}}
                            <div class="col-md-6">
                                <h5 class="text-secondary border-bottom pb-2 mb-3">Dettagli Soggiorno</h5>
                                <p class="mb-1"><strong>Arrivo:</strong> {{ \Carbon\Carbon::parse($prenotazione->data_inizio)->format('d/m/Y') }}</p>
                                <p class="mb-1"><strong>Partenza:</strong> {{ $dataPartenzaUser->format('d/m/Y') }}</p>
                                <p class="mb-1"><strong>Durata:</strong> {{ $durata }} {{ $durata == 1 ? 'giorno' : 'giorni' }}</p>
                            </div>

                            {{-- Sezione Economica --}}
                            <div class="col-12">
                                <div class="bg-light p-3 rounded">
                                    <h5 class="text-secondary border-bottom pb-2 mb-3">Riepilogo Costi</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Costo Totale:</strong><br>
                                            <span class="fs-5">{{ number_format($prenotazione->costo_totale, 2, ',', '.') }} €</span>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Acconto Versato:</strong><br>
                                            <span class="fs-5 text-success">{{ number_format($prenotazione->acconto, 2, ',', '.') }} €</span>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Saldo:</strong><br>
                                            @php
                                                $saldo = $prenotazione->costo_totale - $prenotazione->acconto;
                                            @endphp
                                            <span class="fs-5 {{ $saldo > 0 ? 'text-danger' : 'text-success' }}">
                                                {{ number_format($saldo, 2, ',', '.') }} €
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Note --}}
                            @if($prenotazione->note)
                            <div class="col-12">
                                <h5 class="text-secondary border-bottom pb-2 mb-3">Note</h5>
                                <div class="alert alert-warning mb-0">
                                    {{ $prenotazione->note }}
                                </div>
                            </div>
                            @endif

                        </div>

                        {{-- Bottoni Azione --}}
                        <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                            {{-- Bottone Modifica --}}
                            <a href="{{ route('prenotazioni.edit', $prenotazione->id) }}" class="btn btn-info text-dark">
                                <i class="fas fa-edit me-1"></i> Modifica
                            </a>

                            {{-- Form Cancellazione --}}
                            <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white">
                                    <i class="fas fa-trash-alt me-1"></i> Elimina
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>