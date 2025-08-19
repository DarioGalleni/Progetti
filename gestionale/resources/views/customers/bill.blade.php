<x-layout>
    <div class="container mt-5">
        <h1 class="mb-4">Conto per {{ $customer->first_name }} {{ $customer->last_name }} (Camera {{ $customer->room }})</h1>

        <div class="card">
            <div class="card-header">
                Riepilogo Dettagliato
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Costo totale soggiorno:
                        <span class="fw-bold">{{ number_format($customer->total_stay_cost, 2, ',', '.') }} €</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Imposta di soggiorno:
                        <span class="fw-bold">{{ number_format($cityTax, 2, ',', '.') }} €</span>
                    </li>
                    @if($additionalExpensesTotal > 0)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Totale spese aggiuntive:
                            <span class="fw-bold">{{ number_format($additionalExpensesTotal, 2, ',', '.') }} €</span>
                        </li>
                        <ul class="list-group list-group-flush ms-3">
                            @foreach($customer->expenses as $expense)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    - {{ ucfirst($expense->expense_type) }}:
                                    <span>{{ number_format($expense->amount, 2, ',', '.') }} €</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-3 bg-light">
                        <strong>Totale Complessivo:</strong>
                        <span class="fw-bold">{{ number_format($grandTotal, 2, ',', '.') }} €</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Acconto versato:
                        <span class="fw-bold text-danger">- {{ number_format($customer->down_payment, 2, ',', '.') }} €</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-success text-white">
                        <strong>Saldo da pagare:</strong>
                        <span class="fw-bold">{{ number_format($finalBalance, 2, ',', '.') }} €</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('customers.todayDeparturesBilling') }}" class="btn btn-secondary">Torna alla lista</a>
            <button class="btn btn-info" onclick="window.print()">Stampa</button>
        </div>
    </div>
</x-layout>