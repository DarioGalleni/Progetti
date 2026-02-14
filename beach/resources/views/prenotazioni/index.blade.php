@section('title', 'Elenco Prenotazioni')

<x-layout>
    <div class="container mt-4">
        <h2 class="text-sea mb-4 text-center">
            @if($search)
                Risultati ricerca per: "{{ $search }}"
            @else
                Elenco Prenotazioni
            @endif
        </h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card beach-card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 text-primary"><i class="fas fa-list-ul me-2"></i>Risultati</h5>
                    <span class="badge bg-light text-dark border">{{ $prenotazioni->count() }} trovati</span>
                </div>
            </div>
            <div class="card-body p-0">
                @if($prenotazioni->isEmpty())
                    <div class="alert alert-light text-center m-4 py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3 opacity-50"></i>
                        <h5 class="text-muted">Nessuna prenotazione trovata</h5>
                        <p class="text-muted small">Prova a modificare i parametri di ricerca</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    <th class="ps-4">Ombrellone</th>
                                    <th>Cliente</th>
                                    <th>Contatti</th>
                                    <th>Periodo</th>
                                    <th class="text-end pe-4">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prenotazioni as $prenotazione)
                                    <tr class="position-relative">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fas fa-umbrella-beach"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark">
                                                        {{ strtoupper($prenotazione->ombrellone->fila) }} -
                                                        {{ $prenotazione->ombrellone->numero }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</div>
                                        </td>
                                        <td>
                                            @if($prenotazione->telefono)
                                                <div class="small"><i class="fas fa-phone-alt text-muted me-2"
                                                        style="width:16px"></i>{{ $prenotazione->telefono }}</div>
                                            @endif
                                            @if($prenotazione->email)
                                                <div class="small"><i class="fas fa-envelope text-muted me-2"
                                                        style="width:16px"></i>{{ $prenotazione->email }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="small text-muted"> <i class="far fa-calendar-alt me-1"></i>
                                                {{ \Carbon\Carbon::parse($prenotazione->data_inizio)->format('d/m') }} -
                                                {{ \Carbon\Carbon::parse($prenotazione->data_fine)->addDay()->format('d/m/Y') }}
                                            </div>
                                            <div class="badge bg-light text-secondary border mt-1">
                                                {{ \Carbon\Carbon::parse($prenotazione->data_inizio)->diffInDays(\Carbon\Carbon::parse($prenotazione->data_fine)->addDay()) }}
                                                gg
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group shadow-sm" role="group">
                                                <a href="{{ route('prenotazioni.show', $prenotazione->id) }}"
                                                    class="btn btn-sm btn-light text-primary border" data-bs-toggle="tooltip"
                                                    title="Visualizza">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('prenotazioni.edit', $prenotazione->id) }}"
                                                    class="btn btn-sm btn-light text-warning border" data-bs-toggle="tooltip"
                                                    title="Modifica">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-light text-danger border"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $prenotazione->id }}"
                                                    title="Elimina">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $prenotazione->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Conferma Eliminazione</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            Sei sicuro di voler eliminare la prenotazione di
                                                            <strong>{{ $prenotazione->nome }}
                                                                {{ $prenotazione->cognome }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annulla</button>
                                                            <form
                                                                action="{{ route('prenotazioni.destroy', $prenotazione->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Elimina</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-3 text-center">
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="fas fa-home me-1"></i> Torna alla Home
            </a>
            @if($search)
                <a href="{{ route('prenotazioni.index') }}" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-list me-1"></i> Mostra tutte
                </a>
            @endif
        </div>
    </div>
</x-layout>