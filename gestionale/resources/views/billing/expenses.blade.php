@extends('components.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 rounded-3 card-custom">
                <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold text-primary mb-0 ms-0">
                            Gestione Spese
                        </h3>
                        <p class="text-muted mt-1 mb-0">
                            {{ $customer->first_name }} {{ $customer->last_name }}
                            <span class="badge bg-light text-dark ms-2 border">Camera {{ $customer->room_number }}</span>
                        </p>
                    </div>
                    <div class="text-end">
                        <h4 class="fw-bold mb-0 text-danger">Totale Extra: €
                            {{ number_format($expenses->sum('amount'), 2, ',', '.') }}
                        </h4>
                        <a href="{{ route('customers.show', $customer) }}"
                            class="btn btn-outline-secondary btn-sm mt-2">Torna al Cliente</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <!-- Left Column: Inputs -->
                        <div class="col-md-5 col-12 border-md-end mb-4 mb-md-0">
                            <h5 class="mb-4 text-muted">Aggiungi / Aggiorna</h5>
                            <form action="{{ route('billing.expenses.update', $customer) }}" method="POST">
                                @csrf

                                @php
                                    $categories = [
                                        'spiaggia' => 'bi bi-umbrella',
                                        'bici' => 'bi bi-bicycle',
                                        'pasti' => 'bi bi-egg-fried',
                                        'bevande' => 'bi bi-cup-straw',
                                        'late_checkout' => 'bi bi-clock'
                                    ];
                                @endphp

                                <div class="vstack gap-3">
                                    @foreach($categories as $key => $icon)
                                        @php
                                            $desc = ucfirst(str_replace('_', ' ', $key));
                                            $currentTotal = $totals[$desc] ?? 0;
                                        @endphp

                                        <div class="card border-0 shadow-sm bg-light">
                                            <div class="card-body py-2 px-3">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    @if($key === 'bevande')
                                                        <label for="{{ $key }}" class="fw-bold text-dark mb-0 small">
                                                            <i class="{{ $icon }} me-1"></i> {{ $desc }}
                                                        </label>
                                                        <span class="badge bg-white text-dark border">
                                                            Tot: € {{ number_format($beverageTotal ?? 0, 2, ',', '.') }}
                                                        </span>
                                                    @else
                                                        <label for="{{ $key }}" class="fw-bold text-dark mb-0 small">
                                                            <i class="{{ $icon }} me-1"></i> {{ $desc }}
                                                        </label>
                                                        <span class="badge bg-white text-dark border">
                                                            Tot: € {{ number_format($currentTotal, 2, ',', '.') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="input-group input-group-sm">
                                                    @if($key === 'bevande' && isset($beverageTypes))
                                                        <select name="expenses[{{ $key }}][type]" class="form-select form-select-sm"
                                                            style="max-width: 40%">
                                                            @foreach($beverageTypes as $type)
                                                                <option value="{{ $type }}">{{ $type }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="btn btn-outline-secondary d-md-none"
                                                            onclick="toggleSign(this)">+/-</button>
                                                        <input type="text" inputmode="decimal" class="form-control text-end"
                                                            id="{{ $key }}" name="expenses[{{ $key }}][amount]" placeholder="0">
                                                    @else
                                                        <button type="button" class="btn btn-outline-secondary d-md-none"
                                                            onclick="toggleSign(this)">+/-</button>
                                                        <input type="text" inputmode="decimal" class="form-control text-end"
                                                            id="{{ $key }}" name="expenses[{{ $key }}][amount]" placeholder="0">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="alert alert-info mt-4 py-2 small">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Usa il pulsante <strong>+/-</strong> per invertire il segno e stornare.
                                </div>

                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-save me-2"></i>Salva Movimenti
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Right Column: History -->
                        <div class="col-md-7 col-12 ps-md-4">
                            <h5 class="mb-4 text-muted">Storico Movimenti</h5>
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-hover table-sm">
                                    <thead class="table-light sticky-top">
                                        <tr>
                                            <th>Data</th>
                                            <th>Descrizione</th>
                                            <th class="text-end">Importo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($expenses as $expense)
                                            <tr>
                                                <td class="small">{{ $expense->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $expense->description }}</td>
                                                <td
                                                    class="text-end fw-bold {{ $expense->amount < 0 ? 'text-success' : ($expense->amount > 0 ? 'text-danger' : '') }}">
                                                    € {{ number_format($expense->amount, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-5">
                                                    Nessun movimento registrato.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Toggle Sign Function per stornare
        function toggleSign(btn) {
            // Trova l'input all'interno dello stesso input-group
            var input = btn.closest('.input-group').querySelector('input[type="text"]');
            if (input) {
                var currentValue = input.value;

                // Se è vuoto, inizia con -
                if (currentValue === '') {
                    input.value = '-';
                }
                // Se c'è già un meno all'inizio, lo toglie
                else if (currentValue.startsWith('-')) {
                    input.value = currentValue.substring(1);
                }
                // Altrimenti aggiunge il meno davanti
                else {
                    input.value = '-' + currentValue;
                }
                // Rimetti il focus sull'input
                input.focus();
            }
        }
    </script>
@endsection