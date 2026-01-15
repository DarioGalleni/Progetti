<x-layout>
    @section('title', 'Aggiungi Gruppo')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                        <h4 class="mb-0 text-primary fw-bold text-center">
                            <i class="fas fa-users me-2"></i>Aggiungi Gruppo
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        {{-- Errori di validazione --}}
                        @if ($errors->any())
                            <div class="alert alert-danger shadow-sm border-0 mb-4 rounded-3">
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
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold text-secondary">Descrizione
                                    Gruppo</label>
                                <input type="text" class="form-control form-control-lg shadow-sm" id="description"
                                    name="description" value="{{ old('description') }}"
                                    placeholder="Es. Gita Scolastica" required>
                                <div class="form-text">Questo nome apparirà nel calendario.</div>
                            </div>

                            {{-- Date --}}
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="arrival_date" class="form-label fw-bold text-secondary">Data
                                        Arrivo</label>
                                    <input type="date" class="form-control shadow-sm" id="arrival_date"
                                        name="arrival_date" value="{{ old('arrival_date') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="departure_date" class="form-label fw-bold text-secondary">Data
                                        Partenza</label>
                                    <input type="date" class="form-control shadow-sm" id="departure_date"
                                        name="departure_date" value="{{ old('departure_date') }}" required>
                                </div>
                            </div>

                            {{-- Selezione Camere --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary d-block mb-2">Seleziona Camere</label>
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="select-all">
                                        <i class="fas fa-check-double me-1"></i>Tutte
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="deselect-all">
                                        <i class="fas fa-times me-1"></i>Nessuna
                                    </button>
                                </div>

                                <div class="row g-2" id="rooms-container">
                                    @foreach ($rooms as $roomNumber => $roomLabel)
                                        <div class="col-4 col-sm-3 col-md-3">
                                            <div class="form-check card h-100 p-2 border shadow-sm text-center">
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

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill fw-bold">
                                    <i class="fas fa-save me-2"></i>Crea Gruppo
                                </button>
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary rounded-pill">
                                    Annulla
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllBtn = document.getElementById('select-all');
            const deselectAllBtn = document.getElementById('deselect-all');
            const checkboxes = document.querySelectorAll('.room-checkbox');

            selectAllBtn.addEventListener('click', function () {
                checkboxes.forEach(cb => cb.checked = true);
            });

            deselectAllBtn.addEventListener('click', function () {
                checkboxes.forEach(cb => cb.checked = false);
            });
        });
    </script>
</x-layout>