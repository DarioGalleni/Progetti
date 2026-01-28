<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white border-0 pt-4 pb-2 text-center">
                        <h2 class="fw-bold text-primary mb-0">
                            <i class="fas fa-user-plus me-2"></i>Inserisci un nuovo cliente
                        </h2>
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

                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label fw-bold small text-muted">Nome</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required
                                        value="{{ old('first_name') }}" placeholder="Nome">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label fw-bold small text-muted">Cognome</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name') }}" placeholder="Cognome">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold small text-muted">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i
                                            class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="email@esempio.com">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-bold small text-muted">Telefono</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i
                                                class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') }}" placeholder="+39 ...">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="room" class="form-label fw-bold small text-muted">Camera</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted"><i
                                                class="fas fa-door-closed"></i></span>
                                        <select class="form-select" id="room" name="room" required>
                                            <option value="" disabled selected>Seleziona Camera</option>
                                            @foreach(config('rooms') as $number => $label)
                                                <option value="{{ $number }}" {{ old('room') == $number ? 'selected' : '' }}>
                                                    {{ $number }} - {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="arrival_date" class="form-label fw-bold small text-muted">Data di
                                        arrivo</label>
                                    <input type="date" class="form-control" id="arrival_date" name="arrival_date"
                                        required value="{{ old('arrival_date', date('Y-m-d')) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="departure_date" class="form-label fw-bold small text-muted">Data di
                                        partenza</label>
                                    <input type="date" class="form-control" id="departure_date" name="departure_date"
                                        required
                                        value="{{ old('departure_date', date('Y-m-d', strtotime('+1 day'))) }}">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="treatment"
                                        class="form-label fw-bold small text-muted">Trattamento</label>
                                    <select class="form-select" id="treatment" name="treatment" required>
                                        <option value="BB" {{ old('treatment') == 'BB' ? 'selected' : '' }}>BB (Bed &
                                            Breakfast)</option>
                                        <option value="HB" {{ old('treatment') == 'HB' ? 'selected' : '' }}>HB (Half
                                            Board)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="number_of_people" class="form-label fw-bold small text-muted">Numero
                                        persone</label>
                                    <input type="number" class="form-control" id="number_of_people"
                                        name="number_of_people" value="{{ old('number_of_people') }}" min="1">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="total_stay_cost" class="form-label fw-bold small text-muted">Totale
                                        soggiorno (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="total_stay_cost"
                                            name="total_stay_cost" required value="{{ old('total_stay_cost') }}"
                                            step="0.01">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="down_payment" class="form-label fw-bold small text-muted">Acconto
                                        (€)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="down_payment" name="down_payment"
                                            value="{{ old('down_payment') }}" step="0.01">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch p-3 bg-light rounded border">
                                <input type="hidden" name="is_booking" value="0">
                                <input class="form-check-input" type="checkbox" id="is_booking" name="is_booking"
                                    value="1" {{ old('is_booking') ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small text-muted ms-2"
                                    for="is_booking">Prenotazione Booking.com</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch p-3 bg-light rounded border">
                                <input type="hidden" name="is_cash_payment" value="0">
                                <input class="form-check-input" type="checkbox" id="is_cash_payment"
                                    name="is_cash_payment" value="1" {{ old('is_cash_payment') ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small text-muted ms-2"
                                    for="is_cash_payment">Pagamento in Contanti</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="additional_notes" class="form-label fw-bold small text-muted">Note
                            Aggiuntive</label>
                        <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3"
                            placeholder="Inserisci eventuali note...">{{ old('additional_notes') }}</textarea>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm rounded-pill">
                            <i class="fas fa-save me-2"></i>Salva Cliente
                        </button>
                        <a href="{{ route('welcome') }}"
                            class="btn btn-link text-decoration-none text-muted">Annulla</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layout>