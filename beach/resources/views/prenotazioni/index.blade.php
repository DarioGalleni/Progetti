@section('title', 'Elenco Prenotazioni')
<x-layout class="beach-theme">
    <div class="container mt-4">
        <div class="card beach-card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Elenco Prenotazioni</h5>
                <a href="{{ route('home') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-umbrella-beach"></i> Vai al Calendario
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>✅ Successo!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>❌ Errore!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($prenotazioni->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Nessuna prenotazione presente.
                    </div>
                @else

                    {{-- Inizio Blocco Ordinamento Dinamico --}}
                    @php
                        // Funzione helper per generare l'URL di ordinamento: inverte la direzione se la colonna è già selezionata
                        $getSortUrl = function($column) use ($sortBy, $sortDirection) {
                            $newDirection = ($sortBy === $column && $sortDirection === 'asc') ? 'desc' : 'asc';
                            return route('prenotazioni.index', ['sort' => $column, 'direction' => $newDirection]);
                        };

                        // Funzione helper per l'icona di ordinamento
                        $getSortIcon = function($column) use ($sortBy, $sortDirection) {
                            if ($sortBy !== $column) {
                                return '<i class="fas fa-sort text-muted ms-1"></i>'; // Icona default
                            }
                            return $sortDirection === 'asc' 
                                ? '<i class="fas fa-sort-up ms-1"></i>'    // Icona crescente
                                : '<i class="fas fa-sort-down ms-1"></i>'; // Icona decrescente
                        };
                    @endphp
                    {{-- Fine Blocco Ordinamento Dinamico --}}

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    {{-- Colonna Ombrellone con link di ordinamento --}}
                                    <th>
                                        <a href="{{ $getSortUrl('ombrellone') }}" class="text-decoration-none text-dark d-block">
                                            Ombrellone {!! $getSortIcon('ombrellone') !!}
                                        </a>
                                    </th>
                                    <th>Cliente</th>
                                    {{-- Colonna Arrivo con link di ordinamento --}}
                                    <th>
                                        <a href="{{ $getSortUrl('arrivo') }}" class="text-decoration-none text-dark d-block">
                                            Arrivo {!! $getSortIcon('arrivo') !!}
                                        </a>
                                    </th>
                                    {{-- Colonna Partenza con link di ordinamento --}}
                                    <th>
                                        <a href="{{ $getSortUrl('partenza') }}" class="text-decoration-none text-dark d-block">
                                            Partenza {!! $getSortIcon('partenza') !!}
                                        </a>
                                    </th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prenotazioni as $prenotazione)
                                    <tr>
                                        {{-- Ombrellone (Rimosso **) --}}
                                        <td>{{ $prenotazione->ombrellone->identificativo }}</td>
                                        <td>{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</td>
                                        {{-- Arrivo --}}
                                        <td>{{ \Carbon\Carbon::parse($prenotazione->data_inizio)->format('d/m/Y') }}</td>
                                        {{-- Partenza (Data Fine + 1 giorno, Rimosso **) --}}
                                        <td>{{ \Carbon\Carbon::parse($prenotazione->data_fine)->addDay()->format('d/m/Y') }}</td>
                                        {{-- Azioni --}}
                                        <td>
                                            {{-- MODIFICA: Wrapper per bottoni azione --}}
                                            <div class="d-grid gap-1 d-md-block">
                                                <button type="button" class="btn btn-info btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $prenotazione->id }}">
                                                    <i class="fas fa-eye"></i> Dettagli
                                                </button>
                                                {{-- MODIFICA: data-bs-target e classe action-btn --}}
                                                <button type="button" class="btn btn-danger btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $prenotazione->id }}">
                                                    <i class="fas fa-trash"></i> Elimina
                                                </button>
                                                <a href="{{ route('prenotazioni.edit', $prenotazione->id) }}" class="btn btn-warning btn-sm action-btn">
                                                    <i class="fas fa-pen"></i> Modifica
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- MODAL DETTAGLI --}}
                                    <div class="modal fade" id="detailsModal{{ $prenotazione->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $prenotazione->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white d-flex justify-content-center">
                                                    <button type="button" class="btn-close invisible" aria-hidden="true"></button>
                                                    <h5 class="modal-title" id="detailsModalLabel{{ $prenotazione->id }}">Dettagli Prenotazione</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Ombrellone:</dt>
                                                        <dd class="col-sm-8">{{ $prenotazione->ombrellone->identificativo }}</dd>

                                                        <dt class="col-sm-4">Nome:</dt>
                                                        <dd class="col-sm-8">{{ $prenotazione->nome }}</dd>

                                                        <dt class="col-sm-4">Cognome:</dt>
                                                        <dd class="col-sm-8">{{ $prenotazione->cognome }}</dd>

                                                        <dt class="col-sm-4">Arrivo:</dt>
                                                        <dd class="col-sm-8 text-success">{{ \Carbon\Carbon::parse($prenotazione->data_inizio)->format('d/m/Y') }}</dd>

                                                        <dt class="col-sm-4">Partenza:</dt>
                                                        <dd class="col-sm-8 text-danger">{{ \Carbon\Carbon::parse($prenotazione->data_fine)->addDay()->format('d/m/Y') }}</dd>

                                                        <dt class="col-sm-4">Email:</dt>
                                                        <dd class="col-sm-8"><a href="mailto:{{ $prenotazione->email ?? '' }}" >{{ $prenotazione->email ?? '' }}</a></dd>

                                                        <dt class="col-sm-4">Telefono:</dt>
                                                        <dd class="col-sm-8"><a href="tel:{{ $prenotazione->telefono ?? '' }}" >{{ $prenotazione->telefono ?? '' }}</a></dd>

                                                        <dt class="col-sm-4">WhatsApp:</dt>
                                                        <dd class="col-sm-8"><a id="whatsapp" href="https://wa.me/39{{ $prenotazione->telefono }}" target="blank" >Invia Messaggio</a></dd>

                                                        <dt class="col-sm-4">Note:</dt>
                                                        <dd class="col-sm-8" >{{ $prenotazione->note ?? '' }}</dd>

                                                        @if($prenotazione->costo_totale)
                                                            <hr class="mt-2 mb-2">
                                                            <dt class="col-sm-4">Costo Totale:</dt>
                                                            <dd class="col-sm-8">€{{ number_format($prenotazione->costo_totale, 2, ',', '.') }}</dd>
                                                        @endif

                                                        @if($prenotazione->acconto)
                                                            <dt class="col-sm-4">Acconto Versato:</dt>
                                                            <dd class="col-sm-8">€{{ number_format($prenotazione->acconto, 2, ',', '.') }}</dd>
                                                        @endif

                                                        @if($prenotazione->costo_totale && $prenotazione->acconto)
                                                            <dt class="col-sm-4">Saldo:</dt>
                                                            <dd class="col-sm-8">
                                                                <strong>€{{ number_format($prenotazione->costo_totale - $prenotazione->acconto, 2, ',', '.') }}</strong>
                                                            </dd>
                                                        @endif

                                                        <dt class="col-sm-4">Creata il:</dt>
                                                        <dd class="col-sm-8">{{ $prenotazione->created_at->format('d/m/Y H:i') }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- FINE MODAL DETTAGLI --}}
                                    
                                    {{-- AGGIUNTO: MODAL ELIMINAZIONE --}}
                                    <div class="modal fade" id="deleteModal{{ $prenotazione->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $prenotazione->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $prenotazione->id }}">Conferma Eliminazione</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicuro di voler eliminare la prenotazione per 
                                                    <strong>{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</strong>
                                                    sull'ombrellone <strong>{{ $prenotazione->ombrellone->identificativo }}</strong>?
                                                    <br><br>
                                                    L'azione è irreversibile.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                    <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Elimina Definitivamente</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- FINE MODAL ELIMINAZIONE --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>