<x-layout>
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
                                <a href="{{ route('prenotazioni.index') }}" class="alert-link ms-2">Vai alla lista</a>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('prenotazioni.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <h6 class="text-primary border-bottom pb-2 mb-3"><i
                                            class="fas fa-umbrella-beach me-2"></i>Dettagli Soggiorno</h6>
                                </div>

                                <div class="col-md-12">
                                    <label for="ombrellone_id" class="form-label">Ombrellone <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('ombrellone_id') is-invalid @enderror"
                                        id="ombrellone_id" name="ombrellone_id" required>
                                        <option value="" disabled {{ !isset($ombrellone) && !old('ombrellone_id') ? 'selected' : '' }}>Seleziona...</option>
                                        @foreach($ombrelloni as $o)
                                            <option value="{{ $o->id }}" {{ (isset($ombrellone) && $ombrellone->id == $o->id) || old('ombrellone_id') == $o->id ? 'selected' : '' }}>Fila {{ $o->fila }} -
                                                N. {{ $o->numero }}</option>
                                        @endforeach
                                    </select>
                                    @error('ombrellone_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="arrivo" class="form-label">Data Arrivo <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('arrivo') is-invalid @enderror"
                                        id="arrivo" name="arrivo" value="{{ old('arrivo', $dataInizio) }}"
                                        min="{{ date('Y-m-d') }}" required>
                                    @error('arrivo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="partenza" class="form-label">Data Partenza <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('partenza') is-invalid @enderror"
                                        id="partenza" name="partenza" value="{{ old('partenza') }}" required>
                                    @error('partenza') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <div class="form-text text-muted small">Ultimo giorno di utilizzo (libero dal giorno
                                        successivo).</div>
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary border-bottom pb-2 mb-3"><i
                                            class="fas fa-user me-2"></i>Dati Cliente</h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                        id="nome" name="nome" value="{{ old('nome') }}" required>
                                    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="cognome" class="form-label">Cognome <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('cognome') is-invalid @enderror"
                                        id="cognome" name="cognome" value="{{ old('cognome') }}" required>
                                    @error('cognome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror"
                                            id="telefono" name="telefono" value="{{ old('telefono') }}">
                                    </div>
                                    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}">
                                    </div>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 mt-4">
                                    <h6 class="text-primary border-bottom pb-2 mb-3"><i
                                            class="fas fa-euro-sign me-2"></i>Pagamento & Note</h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="costo_totale" class="form-label">Costo Totale (€)</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control @error('costo_totale') is-invalid @enderror"
                                        id="costo_totale" name="costo_totale" value="{{ old('costo_totale') }}">
                                    @error('costo_totale') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="acconto" class="form-label">Acconto (€)</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control @error('acconto') is-invalid @enderror" id="acconto"
                                        name="acconto" value="{{ old('acconto') }}">
                                    @error('acconto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea class="form-control" id="note" name="note"
                                        rows="2">{{ old('note') }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('home') }}" class="btn btn-secondary"><i
                                        class="fas fa-arrow-left"></i> Annulla</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>
                                    Conferma Prenotazione</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>