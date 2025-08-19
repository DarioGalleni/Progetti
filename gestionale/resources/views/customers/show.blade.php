<x-layout>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Dettagli Prenotazione per {{ $customer->first_name }} {{ $customer->last_name }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Informazioni Cliente</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nome:</strong> {{ $customer->first_name }}</li>
                            <li class="list-group-item"><strong>Cognome:</strong> {{ $customer->last_name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $customer->email }}</li>
                            <li class="list-group-item"><strong>Telefono:</strong> {{ $customer->phone ?? 'Nessun telefono' }}</li>
                        </ul>

                        <h5 class="card-title mt-4">Dettagli Soggiorno</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Camera:</strong> {{ $customer->room }}</li>
                            <li class="list-group-item"><strong>Data di arrivo:</strong> {{ date('d/m/Y', strtotime($customer->arrival_date)) }}</li>
                            <li class="list-group-item"><strong>Data di partenza:</strong> {{ date('d/m/Y', strtotime($customer->departure_date)) }}</li>
                            <li class="list-group-item"><strong>Trattamento:</strong> {{ $customer->treatment }}</li>
                            <li class="list-group-item"><strong>Numero persone:</strong> {{ $customer->number_of_people }}</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h5 class="card-title">Dati Finanziari</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Costo totale:</strong> {{ number_format($customer->total_stay_cost, 2, ',', '.') }} €</li>
                            <li class="list-group-item"><strong>Acconto:</strong> {{ number_format($customer->down_payment, 2, ',', '.') }} €</li>
                        </ul>
                        
<h5 class="card-title mt-4">Spese Aggiuntive</h5>
@if ($customer->expenses->isNotEmpty())
    <ul class="list-group list-group-flush">
        @foreach ($customer->expenses as $expense)
            <li class="list-group-item"><strong>{{ ucfirst($expense->expense_type) }}:</strong> {{ number_format($expense->amount, 2, ',', '.') }} €</li>
        @endforeach
    </ul>
@else
    <p>Nessuna spesa aggiuntiva registrata.</p>
@endif
                    </div>
                </div>

                <div class="d-flex justify-content-start gap-2 mt-4">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Modifica</a>
                    <a href="{{ route('customers.showUpdateExpenses', $customer->id) }}" class="btn btn-info">Aggiorna Spese</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
                <a href="{{ route('welcome') }}" class="btn btn-primary mt-4">Torna al Calendario</a>
            </div>
        </div>
    </div>
</x-layout>