<x-layout class="vh-100">
    @section('title', 'Inserisci Prenotazione')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card beach-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-calendar-plus"></i> Nuova Prenotazione</h5>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                                <a href="{{ route('prenotazioni.index') }}" class="alert-link ms-2">Vai alla lista prenotazioni</a>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('prenotazioni.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="ombrellone_id" class="form-label">
                                    Ombrellone <span class="text-danger">*</span>
                                </label>

                                <select class="form-select @error('ombrellone_id') is-invalid @enderror"
                                        id="ombrellone_id"
                                        name="ombrellone_id"
                                        required>
                                    <option value="" disabled
                                        {{ !isset($ombrellone) && !old('ombrellone_id') ? 'selected' : '' }}>
                                        Seleziona un ombrellone
                                    </option>

                                    @foreach($ombrelloni as $o)
                                        <option value="{{ $o->id }}"
                                            {{ (isset($ombrellone) && $ombrellone->id == $o->id) || old('ombrellone_id') == $o->id ? 'selected' : '' }}>
                                            Fila {{ $o->fila }} - N. {{ $o->numero }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('ombrellone_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="arrivo" class="form-label">
                                        Data di Arrivo <span class="text-danger">*</span>
                                    </label>

                                    <input type="date"
                                           class="form-control @error('arrivo') is-invalid @enderror"
                                           id="arrivo"
                                           name="arrivo"
                                           value="{{ old('arrivo', $dataInizio) }}"
                                           required>

                                    @error('arrivo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="partenza" class="form-label">
                                        Data di Partenza <span class="text-danger">*</span>
                                    </label>

                                    <input type="date"
                                           class="form-control @error('partenza') is-invalid @enderror"
                                           id="partenza"
                                           name="partenza"
                                           value="{{ old('partenza') }}"
                                           required>

                                    @error('partenza')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <p class="text-muted small mb-3">
                                Nota: La data di partenza è il primo giorno in cui l'ombrellone sarà libero.
                                L'ombrellone risulterà occupato fino al giorno precedente.
                            </p>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nome" class="form-label">
                                        Nome <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                           class="form-control @error('nome') is-invalid @enderror"
                                           id="nome"
                                           name="nome"
                                           value="{{ old('nome') }}"
                                           required>

                                    @error('nome')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="cognome" class="form-label">
                                        Cognome <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                           class="form-control @error('cognome') is-invalid @enderror"
                                           id="cognome"
                                           name="cognome"
                                           value="{{ old('cognome') }}"
                                           required>

                                    @error('cognome')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Telefono (Opzionale)</label>

                                    <input type="number"
                                           class="form-control @error('telefono') is-invalid @enderror"
                                           id="telefono"
                                           name="telefono"
                                           value="{{ old('telefono') }}">

                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email (Opzionale)</label>

                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}">

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="costo_totale" class="form-label">Costo Totale (€)</label>

                                    <input type="number"
                                           class="form-control @error('costo_totale') is-invalid @enderror"
                                           id="costo_totale"
                                           name="costo_totale"
                                           value="{{ old('costo_totale') }}"
                                           step="0.01"
                                           min="0">

                                    @error('costo_totale')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="acconto" class="form-label">Acconto (€)</label>

                                    <input type="number"
                                           class="form-control @error('acconto') is-invalid @enderror"
                                           id="acconto"
                                           name="acconto"
                                           value="{{ old('acconto') }}"
                                           step="0.01"
                                           min="0">

                                    @error('acconto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Note (Opzionale)</label>

                                <textarea class="form-control @error('note') is-invalid @enderror"
                                          id="note"
                                          name="note"
                                          rows="3">{{ old('note') }}</textarea>

                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-info">
                                <small>
                                    <i class="bi bi-info-circle"></i>
                                    I campi contrassegnati con
                                    <span class="text-danger">*</span> sono obbligatori
                                </small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('home') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Annulla
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle"></i> Conferma Prenotazione
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>