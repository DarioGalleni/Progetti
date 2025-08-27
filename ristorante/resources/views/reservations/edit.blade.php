<x-layout>
    <section class="hero-section vh-25 d-flex align-items-center justify-content-center text-white text-center" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('media/img/home-section.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="hero-title">Modifica Prenotazione</h1>
            <p class="hero-subtitle">Nome: <span class="fw-bold">{{ $reservation->customer->name }}</span></p>
            <p class="hero-subtitle">Codice: <span class="fw-bold">{{ $reservation->reservation_code }}</span></p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary">← Torna alle prenotazioni</a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nome e Cognome</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $reservation->customer->name ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefono</label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $reservation->customer->phone ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $reservation->customer->email ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="people" class="form-label">Numero di persone</label>
                                <select id="people" name="people" class="form-select" required>
                                    @for($i=1;$i<=20;$i++)
                                        <option value="{{ $i }}" {{ (int)old('people', $reservation->people) === $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i === 1 ? 'persona' : 'persone' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date" class="form-label">Data</label>
                                <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $reservation->date) }}" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="time" class="form-label">Ora</label>
                                <select id="time" name="time" class="form-select" required>
                                    <option value="" disabled>Seleziona un orario</option>
                                    <optgroup label="Pranzo">
                                        @for ($h = 12; $h <= 13; $h++)
                                            @for ($m = 0; $m < 60; $m += 15)
                                                @php $val = sprintf('%02d:%02d', $h, $m); @endphp
                                                <option value="{{ $val }}" {{ old('time', $reservation->time) === $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        @endfor
                                        <option value="14:00" {{ old('time', $reservation->time) === '14:00' ? 'selected' : '' }}>14:00</option>
                                    </optgroup>
                                    <optgroup label="Cena">
                                        @for ($h = 19; $h <= 22; $h++)
                                            @for ($m = 0; $m < 60; $m += 15)
                                                @php $val = sprintf('%02d:%02d', $h, $m); @endphp
                                                <option value="{{ $val }}" {{ old('time', $reservation->time) === $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        @endfor
                                        <option value="23:00" {{ old('time', $reservation->time) === '23:00' ? 'selected' : '' }}>23:00</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Note aggiuntive</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3">{{ old('notes', $reservation->notes) }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Tavoli riservati:</strong></p>
                                <p>{{ \App\Models\Reservation::calculateTablesRequired(old('people', $reservation->people)) }}</p>
                            </div>
                            <div class="col-md-8 text-end">
                                <button type="submit" class="btn btn-primary">Salva modifiche</button>
                                <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary ms-2">Annulla</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</x-layout>