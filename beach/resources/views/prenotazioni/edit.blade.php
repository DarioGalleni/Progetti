<x-layout class="beach-theme">
    <x-slot name="title">Modifica Prenotazione</x-slot>

    <div class="container mt-4 beach-card p-3">
        <h1 class="mb-4 text-sea">Modifica Prenotazione</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('prenotazioni.update', $prenotazione->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ombrellone_id" class="form-label">Ombrellone</label>
                <select class="form-select" id="ombrellone_id" name="ombrellone_id" required>
                    @foreach ($ombrelloni as $ombrellone)
                        <option value="{{ $ombrellone->id }}" 
                                {{ old('ombrellone_id', $prenotazione->ombrellone_id) == $ombrellone->id ? 'selected' : '' }}>
                            Fila {{ $ombrellone->fila }} - Numero {{ $ombrellone->numero }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $prenotazione->nome) }}" required>
            </div>

            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="cognome" name="cognome" value="{{ old('cognome', $prenotazione->cognome) }}" required>
            </div>

            <div class="mb-3">
                <label for="arrivo" class="form-label">Data Arrivo</label>
                <input type="date" class="form-control" id="arrivo" name="arrivo" value="{{ old('arrivo', $dataInizio) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="partenza" class="form-label">Data Partenza</label>
                <input type="date" class="form-control" id="partenza" name="partenza" value="{{ old('partenza', $dataPartenza) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $prenotazione->email) }}">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $prenotazione->telefono) }}">
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea class="form-control" id="note" name="note">{{ old('note', $prenotazione->note) }}</textarea>
            </div>
            
            <div class="d-grid d-md-flex justify-content-md-start gap-3 mt-4">
                <button type="submit" class="btn btn-primary action-btn">Aggiorna Prenotazione</button>
                <a href="{{ route('prenotazioni.index') }}" class="btn btn-secondary action-btn">Annulla</a>
                
                <button type="button" class="btn btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    Elimina Prenotazione
                </button>
            </div>
        </form>
        
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Conferma Eliminazione</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare la prenotazione <span class="fw-bold">{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</span> ? <br>
                        L' operazione è irreversibile.
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
    </div>
</x-layout>