<x-layout class="beach-theme">
    @section('title', 'Modifica Prenotazione')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card beach-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-pen"></i> Modifica Prenotazione
                        </h5>
                    </div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('prenotazioni.update', $prenotazione->id) }}" method="POST">
                            @csrf
                            @method('PUT')


                            <div class="row g-3">
                                {{-- SEZIONE 1: Dettagli Prenotazione --}}
                                <div class="col-12">
                                    <h6 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-umbrella-beach me-2"></i>Dettagli Soggiorno
                                    </h6>
                                </div>

                                <div class="col-md-12">
                                    <label for="ombrellone_id" class="form-label">Ombrellone <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('ombrellone_id') is-invalid @enderror"
                                        id="ombrellone_id" name="ombrellone_id" required>
                                        @foreach ($ombrelloni as $ombrellone)
                                            <option value="{{ $ombrellone->id }}" {{ old('ombrellone_id', $prenotazione->ombrellone_id) == $ombrellone->id ? 'selected' : '' }}>
                                                Fila {{ $ombrellone->fila }} - Numero {{ $ombrellone->numero }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ombrellone_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="arrivo" class="form-label">Data Arrivo <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('arrivo') is-invalid @enderror"
                                        id="arrivo" name="arrivo"
                                        value="{{ old('arrivo', $prenotazione->data_inizio->format('Y-m-d')) }}"
                                        required>
                                    @error('arrivo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="partenza" class="form-label">Data Partenza <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('partenza') is-invalid @enderror"
                                        id="partenza" name="partenza"
                                        value="{{ old('partenza', \Carbon\Carbon::parse($dataPartenza)->format('Y-m-d')) }}"
                                        required>
                                    @error('partenza') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- SEZIONE 2: Dati Cliente --}}
                                <div class="col-12 mt-4">
                                    <h6 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-user me-2"></i>Dati Cliente
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                        id="nome" name="nome" value="{{ old('nome', $prenotazione->nome) }}" required>
                                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="cognome" class="form-label">Cognome <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('cognome') is-invalid @enderror"
                                        id="cognome" name="cognome" value="{{ old('cognome', $prenotazione->cognome) }}"
                                        required>
                                    @error('cognome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror"
                                            id="telefono" name="telefono"
                                            value="{{ old('telefono', $prenotazione->telefono) }}">
                                    </div>
                                    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $prenotazione->email) }}">
                                    </div>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- SEZIONE 3: Pagamento e Note --}}
                                <div class="col-12 mt-4">
                                    <h6 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-euro-sign me-2"></i>Pagamento & Note
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="costo_totale" class="form-label">Costo Totale (€)</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control @error('costo_totale') is-invalid @enderror"
                                        id="costo_totale" name="costo_totale"
                                        value="{{ old('costo_totale', $prenotazione->costo_totale) }}">
                                    @error('costo_totale') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="acconto" class="form-label">Acconto (€)</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control @error('acconto') is-invalid @enderror" id="acconto"
                                        name="acconto" value="{{ old('acconto', $prenotazione->acconto) }}">
                                    @error('acconto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="note" class="form-label">Note Aggiuntive</label>
                                    <textarea class="form-control @error('note') is-invalid @enderror" id="note"
                                        name="note" rows="2">{{ old('note', $prenotazione->note) }}</textarea>
                                    @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>


                            <div class="alert alert-info">
                                <small>
                                    <i class="bi bi-info-circle"></i>
                                    I campi contrassegnati con <span class="text-danger">*</span> sono obbligatori
                                </small>
                            </div>


                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        <i class="fas fa-trash"></i> Elimina Prenotazione
                                    </button>
                                </div>
                                <div>
                                    <a href="{{ route('prenotazioni.index') }}" class="btn btn-secondary me-2">
                                        <i class="fas fa-arrow-left"></i> Annulla
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Salva Modifiche
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Conferma Eliminazione</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Sei sicuro di voler eliminare la prenotazione
                    <span class="fw-bold">{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</span>?
                    <br>
                    L'operazione è irreversibile.
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Annulla
                    </button>
                    <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Elimina Definitivamente
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>