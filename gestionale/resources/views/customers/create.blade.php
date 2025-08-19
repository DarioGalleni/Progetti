<x-layout>
    <div class="container mt-5">
        <h1>Inserisci un nuovo cliente</h1>

        @if ($errors->has('room'))
            <div class="alert alert-danger">
                {{ $errors->first('room') }}
            </div>
        @endif

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="first_name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required
                    value="{{ old('first_name') }}">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required
                    value="{{ old('last_name') }}">
            </div>
            <div class="mb-3">
                <label for="room" class="form-label">Camera</label>
                <input type="number" class="form-control @error('room') is-invalid @enderror" id="room"
                    name="room" required value="{{ old('room') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required
                    value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefono</label>
                <input type="tel" class="form-control" id="phone" name="phone"
                    value="{{ old('phone') }}">
            </div>
            <div class="mb-3">
                <label for="arrival_date" class="form-label">Data di arrivo</label>
                <input type="date" class="form-control" id="arrival_date" name="arrival_date" required
                    value="{{ old('arrival_date', date('Y-m-d')) }}">
            </div>
            <div class="mb-3">
                <label for="departure_date" class="form-label">Data di partenza</label>
                <input type="date" class="form-control" id="departure_date" name="departure_date" required
                    value="{{ old('departure_date', date('Y-m-d')) }}">
            </div>
            <div class="mb-3">
                <label for="treatment" class="form-label">Trattamento</label>
                <select class="form-select" id="treatment" name="treatment" required>
                    <option value="BB" {{ old('treatment') == 'BB' ? 'selected' : '' }}>BB</option>
                    <option value="HB" {{ old('treatment') == 'HB' ? 'selected' : '' }}>HB</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="number_of_people" class="form-label">Numero persone</label>
                <input type="number" class="form-control" id="number_of_people" name="number_of_people" required
                    value="{{ old('number_of_people') }}">
            </div>
            <div class="mb-3">
                <label for="total_stay_cost" class="form-label">Totale soggiorno </label>
                <input type="number" step="0.01" class="form-control" id="total_stay_cost" name="total_stay_cost"
                    required value="{{ old('total_stay_cost') }}">
            </div>
            <div class="mb-3">
                <label for="down_payment" class="form-label">Acconto</label>
                <input type="number" step="0.01" class="form-control" id="down_payment" name="down_payment"
                    required value="{{ old('down_payment') }}">
            </div>
            <button type="submit" class="btn btn-primary">Salva cliente</button>
        </form>
    </div>
</x-layout>
