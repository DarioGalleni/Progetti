<x-layout>
    <div class="container mt-5">
        <h2 class="mb-4">Modifica Prenotazione per {{ $customer->first_name }} {{ $customer->last_name }}</h2>
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="first_name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $customer->first_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="room" class="form-label">Numero camera</label>
                <input type="number" class="form-control" id="room" name="room" value="{{ old('room', $customer->room) }}" required>
            </div>

            <div class="mb-3">
                <label for="arrival_date" class="form-label">Data di arrivo</label>
                <input type="date" class="form-control" id="arrival_date" name="arrival_date" value="{{ old('arrival_date', $customer->arrival_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="departure_date" class="form-label">Data di partenza</label>
                <input type="date" class="form-control" id="departure_date" name="departure_date" value="{{ old('departure_date', $customer->departure_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="treatment" class="form-label">Trattamento</label>
                <select class="form-control" id="treatment" name="treatment" required>
                    <option value="BB" {{ old('treatment', $customer->treatment) == 'BB' ? 'selected' : '' }}>BB</option>
                    <option value="HB" {{ old('treatment', $customer->treatment) == 'HB' ? 'selected' : '' }}>HB</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="number_of_people" class="form-label">Numero persone</label>
                <input type="number" class="form-control" id="number_of_people" name="number_of_people" value="{{ old('number_of_people', $customer->number_of_people) }}" required min="1">
            </div>

            <div class="mb-3">
                <label for="total_stay_cost" class="form-label">Costo totale soggiorno (€)</label>
                <input type="number" class="form-control" id="total_stay_cost" name="total_stay_cost" value="{{ old('total_stay_cost', $customer->total_stay_cost) }}" required min="0">
            </div>

            <div class="mb-3">
                <label for="down_payment" class="form-label">Acconto (€)</label>
                <input type="number" class="form-control" id="down_payment" name="down_payment" value="{{ old('down_payment', $customer->down_payment) }}" required min="0">
            </div>
            <button type="submit" class="btn btn-success">Salva modifiche</button>
            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
</x-layout>