<x-layout>
    @section('title', 'Conto - ' . $customer->first_name . ' ' . $customer->last_name)
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white border-bottom border-light pt-4 pb-3 text-center">
                        <h3 class="fw-bold text-primary mb-1">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Riepilogo Conto
                        </h3>
                        <p class="text-muted mb-0">
                            {{ $customer->first_name }} {{ $customer->last_name }} <span
                            class="badge bg-light text-dark border ms-2">Camera {{ $customer->room }}</span>
                        </p>
                    </div>

                    <div class="card-body p-4">
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted">Costo totale soggiorno</span>
                                <span class="fw-bold fs-5">{{ number_format($customer->total_stay_cost, 2, ',', '.') }}
                                    €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted">Imposta di soggiorno</span>
                                <span class="fw-bold">{{ number_format($cityTax, 2, ',', '.') }} €</span>
                            </li>

                            @if($additionalExpenses > 0)
                                <li class="list-group-item py-3 bg-light rounded-3 my-2 border-0">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-secondary fw-bold">Totale spese aggiuntive</span>
                                        <span class="fw-bold">{{ number_format($additionalExpenses, 2, ',', '.') }} €</span>
                                    </div>
                                    <ul class="list-group list-group-flush bg-transparent">
                                        @foreach($customer->expenses as $expense)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-bottom border-light py-1 ps-0">
                                                <small class="text-muted"><i class="fas fa-angle-right me-1"></i>
                                                    {{ ucfirst(str_replace('_', ' ', $expense->expense_type)) }}</small>
                                                <small>{{ number_format($expense->amount, 2, ',', '.') }} €</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                            <li
                                class="list-group-item d-flex justify-content-between align-items-center py-3 mt-2 bg-light border-0 rounded-3">
                                <strong class="text-dark">Totale Complessivo</strong>
                                <span class="fw-bold fs-5">{{ number_format($grandTotal, 2, ',', '.') }} €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted">Acconto versato</span>
                                <span class="fw-bold text-danger">-
                                    {{ number_format($customer->down_payment, 2, ',', '.') }} €</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center py-4 bg-success text-white rounded-3 mt-3 shadow-sm">
                                <strong class="fs-4">Saldo da pagare</strong>
                                <span class="fw-bold fs-3">{{ number_format($finalBalance, 2, ',', '.') }} €</span>
                            </li>
                        </ul>

                        @if($customer->additional_notes)
                            <div class="alert alert-warning d-flex align-items-center mt-3 mb-4 shadow-sm border-0 rounded-3" role="alert">
                                <i class="fas fa-sticky-note me-3 fs-3 text-warning"></i>
                                <div>
                                    <h6 class="alert-heading fw-bold mb-1 text-dark">Note Aggiuntive:</h6>
                                    <p class="mb-0 text-muted">{{ $customer->additional_notes }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('customers.print_bill', $customer->id) }}"
                                class="btn btn-info btn-lg text-white shadow-sm rounded-pill px-5" target="_blank"
                                rel="noopener">
                                <i class="fas fa-print me-2"></i>Stampa Conto
                            </a>
                            <a href="{{ route('customers.print_receipt', $customer->id) }}"
                                class="btn btn-success btn-lg text-white shadow-sm rounded-pill px-5" target="_blank"
                                rel="noopener">
                                <i class="fas fa-file-invoice me-2"></i>Stampa Ricevuta
                            </a>
                            <a href="{{ route('customers.todayDeparturesBilling') }}"
                                class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                Torna alla lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>