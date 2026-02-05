@extends('components.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-white border-0 pt-4 pb-2">
                    <h4 class="fw-bold text-primary mb-0">Nuova Prenotazione</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('/customers') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">Nome *</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Cognome</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" value="{{ old('last_name') }}">
                                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="room_number" class="form-label">Camera *</label>
                                <select class="form-select @error('room_number') is-invalid @enderror" id="room_number"
                                    name="room_number" required>
                                    <option value="">Seleziona Camera</option>
                                    @foreach($rooms as $num => $name)
                                        <option value="{{ $num }}" {{ old('room_number') == $num ? 'selected' : '' }}>{{ $num }} -
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('room_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="pax" class="form-label">Persone</label>
                                <input type="number" class="form-control" id="pax" name="pax" value="{{ old('pax', 2) }}"
                                    min="1">
                            </div>
                            <div class="col-md-2">
                                <label for="under_12_pax" class="form-label">Minori 12 anni</label>
                                <input type="number" class="form-control" id="under_12_pax" name="under_12_pax"
                                    value="{{ old('under_12_pax') }}" min="0" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label for="treatment" class="form-label">Trattamento</label>
                                <select class="form-select" id="treatment" name="treatment">
                                    <option value="BB" {{ old('treatment') == 'BB' ? 'selected' : '' }}>BB</option>
                                    <option value="HB" {{ old('treatment') == 'HB' ? 'selected' : '' }}>HB</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="arrival_date" class="form-label">Data Arrivo *</label>
                                <input type="date" class="form-control @error('arrival_date') is-invalid @enderror"
                                    id="arrival_date" name="arrival_date" value="{{ old('arrival_date') }}"
                                    min="{{ date('Y-m-d') }}" required>
                                @error('arrival_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="departure_date" class="form-label">Data Partenza *</label>
                                <input type="date" class="form-control @error('departure_date') is-invalid @enderror"
                                    id="departure_date" name="departure_date" value="{{ old('departure_date') }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                @error('departure_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="total_price" class="form-label">Totale Soggiorno</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" step="0.01"
                                        class="form-control @error('total_price') is-invalid @enderror" id="total_price"
                                        name="total_price" value="{{ old('total_price') }}">
                                </div>
                                @error('total_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="deposit" class="form-label">Acconto</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" step="0.01" class="form-control" id="deposit" name="deposit"
                                        value="{{ old('deposit') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="payment_method" class="form-label">Origine / Pagamento</label>
                                <select class="form-select" id="payment_method" name="payment_method">
                                    <option value="booking" {{ old('payment_method') == 'booking' ? 'selected' : '' }}>
                                        Booking.com</option>
                                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Contanti /
                                        Diretto</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Note Aggiuntive</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Salva Prenotazione</button>
                            <a href="{{ url('/') }}" class="btn btn-light">Annulla</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection