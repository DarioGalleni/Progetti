<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white border-0 pt-4 pb-2 text-center">
                        <h3 class="fw-bold text-primary mb-0">
                            <i class="fas fa-edit me-2"></i>Modifica Prenotazione
                        </h3>
                        <p class="text-muted mt-2">
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </p>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        @if ($errors->any())
                            <div class="alert alert-danger shadow-sm border-0 mb-4 rounded-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label fw-bold small text-muted">Nome</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ old('first_name', $customer->first_name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label fw-bold small text-muted">Cognome</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name', $customer->last_name) }}">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="room" class="form-label fw-bold small text-muted">Numero camera</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i
                                                class="fas fa-door-closed"></i></span>
                                        <input type="number" class="form-control" id="room" name="room"
                                            value="{{ old('room', $customer->room) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="treatment"
                                        class="form-label fw-bold small text-muted">Trattamento</label>
                                    <select class="form-select" id="treatment" name="treatment" required>
                                        <option value="BB" {{ old('treatment', $customer->treatment) == 'BB' ? 'selected' : '' }}>BB</option>
                                        <option value="HB" {{ old('treatment', $customer->treatment) == 'HB' ? 'selected' : '' }}>HB</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="arrival_date" class="form-label fw-bold small text-muted">Data di
                                        arrivo</label>
                                    <input type="date" class="form-control" id="arrival_date" name="arrival_date"
                                        value="{{ old('arrival_date', $customer->arrival_date) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="departure_date" class="form-label fw-bold small text-muted">Data di
                                        partenza</label>
                                    <input type="date" class="form-control" id="departure_date" name="departure_date"
                                        value="{{ old('departure_date', $customer->departure_date) }}" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-bold small text-muted">Telefono</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i
                                                class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone', $customer->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-bold small text-muted">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i
                                                class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $customer->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="number_of_people" class="form-label fw-bold small text-muted">Numero
                                    persone</label>
                                <input type="number" class="form-control" id="number_of_people" name="number_of_people"
                                    value="{{ old('number_of_people', $customer->number_of_people) }}" min="1">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="form-check form-switch p-3 bg-light rounded border">
                                        <input type="hidden" name="is_booking" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_booking"
                                            name="is_booking" value="1" {{ old('is_booking', $customer->is_booking) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold small text-muted ms-2"
                                            for="is_booking">Prenotazione Booking.com</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch p-3 bg-light rounded border">
                                        <input type="hidden" name="is_cash_payment" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_cash_payment"
                                            name="is_cash_payment" value="1" {{ old('is_cash_payment', $customer->is_cash_payment) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold small text-muted ms-2"
                                            for="is_cash_payment">Pagamento in Contanti</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="additional_notes" class="form-label fw-bold small text-muted">Note
                                    Aggiuntive</label>
                                <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3"
                                    placeholder="Inserisci eventuali note...">{{ old('additional_notes', $customer->additional_notes) }}</textarea>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="total_stay_cost" class="form-label fw-bold small text-muted">Costo
                                        totale soggiorno (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="total_stay_cost"
                                            name="total_stay_cost"
                                            value="{{ old('total_stay_cost', $customer->total_stay_cost) }}" required
                                            min="0" step="0.01">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="down_payment" class="form-label fw-bold small text-muted">Acconto
                                        (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="down_payment" name="down_payment"
                                            value="{{ old('down_payment', $customer->down_payment) }}" min="0"
                                            step="0.01">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-success btn-lg shadow-sm rounded-pill">
                                    <i class="fas fa-check me-2"></i>Salva Modifiche
                                </button>
                                <a href="{{ route('customers.show', $customer->id) }}"
                                    class="btn btn-link text-decoration-none text-muted">Annulla</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>