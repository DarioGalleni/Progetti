<x-layout title="Modifica Gruppo">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                        <h4 class="mb-0 text-primary fw-bold text-center">
                            <i class="fas fa-users-cog me-2"></i>Modifica Gruppo
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger shadow-sm border-0 mb-4 rounded-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('groups.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="alert alert-info border-0 shadow-sm mb-4">
                                <i class="fas fa-info-circle me-2"></i>Stai modificando
                                <strong>{{ $siblings->count() }}</strong> camere associate a questo gruppo.
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold text-secondary">Descrizione
                                    Gruppo</label>
                                <input type="text" class="form-control form-control-lg shadow-sm" id="description"
                                    name="description" value="{{ old('description', $customer->group_name) }}" required>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="arrival_date" class="form-label fw-bold text-secondary">Data
                                        Arrivo</label>
                                    <input type="date" class="form-control shadow-sm" id="arrival_date"
                                        name="arrival_date" value="{{ old('arrival_date', $customer->arrival_date) }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="departure_date" class="form-label fw-bold text-secondary">Data
                                        Partenza</label>
                                    <input type="date" class="form-control shadow-sm" id="departure_date"
                                        name="departure_date"
                                        value="{{ old('departure_date', $customer->departure_date) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">Camere Coinvolte:</label>
                                <div>
                                    @foreach($rooms as $room)
                                        <span class="badge bg-secondary me-1 mb-1">Camera {{ $room }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit"
                                    class="btn btn-warning btn-lg shadow rounded-pill fw-bold text-dark">
                                    <i class="fas fa-save me-2"></i>Aggiorna Gruppo
                                </button>
                                <a href="{{ route('customers.show', $customer->id) }}"
                                    class="btn btn-outline-secondary rounded-pill">
                                    Annulla
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>