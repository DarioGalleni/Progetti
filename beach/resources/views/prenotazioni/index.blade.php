<x-layout>
    @section('title', 'Elenco Prenotazioni')
    <div class="container mt-4">
        <h2 class="text-sea mb-4 text-center">{{ $search ? "Risultati ricerca per: \"$search\"" : "Elenco Prenotazioni" }}</h2>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

        <div class="card beach-card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 text-primary"><i class="fas fa-list-ul me-2"></i>Prenotazioni</h5>
                    <span class="badge bg-light text-dark border">{{ $prenotazioni->count() }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                @if($prenotazioni->isEmpty())
                    <div class="alert alert-light text-center m-4 py-5"><h5 class="text-muted">Nessuna prenotazione trovata</h5></div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    <th class="ps-4">Ombrellone</th>
                                    <th>Cliente</th>
                                    <th>Periodo</th>
                                    <th class="text-end pe-4">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prenotazioni as $p)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;"><i class="fas fa-umbrella-beach"></i></div>
                                                <div class="fw-bold">{{ strtoupper($p->ombrellone->fila) }} - {{ $p->ombrellone->numero }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $p->nome }} {{ $p->cognome }}</div>
                                            <div class="small text-muted">{{ $p->telefono }}</div>
                                        </td>
                                        <td>
                                            <div class="small text-muted">{{ \Carbon\Carbon::parse($p->data_inizio)->format('d/m') }} - {{ \Carbon\Carbon::parse($p->data_fine)->addDay()->format('d/m/Y') }}</div>
                                            <div class="badge bg-light text-secondary border mt-1">{{ \Carbon\Carbon::parse($p->data_inizio)->diffInDays(\Carbon\Carbon::parse($p->data_fine)->addDay()) }} gg</div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group shadow-sm">
                                                <a href="{{ route('prenotazioni.show', $p->id) }}" class="btn btn-sm btn-light border" title="Visualizza"><i class="fas fa-eye text-primary"></i></a>
                                                <a href="{{ route('prenotazioni.edit', $p->id) }}" class="btn btn-sm btn-light border" title="Modifica"><i class="fas fa-pen text-warning"></i></a>
                                                <button type="button" class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#del{{ $p->id }}" title="Elimina"><i class="fas fa-trash text-danger"></i></button>
                                            </div>
                                            <div class="modal fade" id="del{{ $p->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white"><h5 class="modal-title">Elimina?</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                                                        <div class="modal-body text-start">Eliminare la prenotazione di <strong>{{ $p->nome }} {{ $p->cognome }}</strong>?</div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                            <form action="{{ route('prenotazioni.destroy', $p->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Elimina</button></form>
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
            <a href="{{ route('home') }}" class="btn btn-secondary">Home</a>
            @if($search) <a href="{{ route('prenotazioni.index') }}" class="btn btn-outline-secondary ms-2">Tutte</a> @endif
        </div>
    </div>
</x-layout>