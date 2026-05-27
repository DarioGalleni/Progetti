<x-layout title="Aggiungi Gruppo">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-white border-0 pt-4 pb-2">
                    <h4 class="fw-bold text-primary mb-0 text-center">Aggiungi Gruppo</h4>
                </div>
                <div class="card-body">
                    {{-- Messaggio di Successo --}}
                    @if(session('success'))
                        <div class="alert alert-success mb-4 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Errori di validazione --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('groups.store') }}" method="POST">
                        @csrf

                        {{-- Descrizione --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione Gruppo</label>
                            <input type="text" class="form-control" id="description" name="description"
                                value="{{ old('description') }}" placeholder="Es. Gita Scolastica" required>
                            <div class="form-text">Questo nome apparirà nel calendario.</div>
                        </div>

                        {{-- Date --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="arrival_date" class="form-label">Data Arrivo</label>
                                <input type="date" class="form-control" id="arrival_date" name="arrival_date"
                                    value="{{ old('arrival_date') }}" min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="departure_date" class="form-label">Data Partenza</label>
                                <input type="date" class="form-control" id="departure_date" name="departure_date"
                                    value="{{ old('departure_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pax" class="form-label">Numero Pax</label>
                            <input type="number" class="form-control" id="pax" name="pax"
                                value="{{ old('pax') }}" min="0">
                        </div>

                        {{-- Note --}}
                        <div class="mb-3">
                            <label for="notes" class="form-label">Note (Opzionale)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                        </div>

                        {{-- Selezione Camere --}}
                        <div class="mb-3">
                            <label class="form-label d-block mb-2">Seleziona Camere</label>
                            <div class="d-flex gap-2 mb-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="select-all">
                                    <i class="fas fa-check-double me-1"></i>Tutte
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="deselect-all">
                                    <i class="fas fa-times me-1"></i>Nessuna
                                </button>
                            </div>

                            <div class="row g-2" id="rooms-container" style="max-height: 300px; overflow-y: auto;">
                                @foreach ($rooms as $roomNumber => $roomLabel)
                                    <div class="col-4 col-sm-3 col-md-3">
                                        <div class="form-check card h-100 p-2 border text-center">
                                            <input class="form-check-input mx-auto float-none mb-1 fs-5 room-checkbox"
                                                type="checkbox" value="{{ $roomNumber }}" id="room-{{ $roomNumber }}"
                                                name="rooms[]" @if(is_array(old('rooms')) && in_array($roomNumber, old('rooms'))) checked @endif>
                                            <label class="form-check-label w-100 stretched-link small fw-bold"
                                                for="room-{{ $roomNumber }}">
                                                {{ $roomNumber }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Crea Gruppo</button>
                            <a href="{{ route('welcome') }}" class="btn btn-light">Annulla</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>