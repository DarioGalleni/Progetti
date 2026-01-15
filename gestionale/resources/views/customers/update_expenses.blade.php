<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-white border-0 pt-4 pb-2 text-center">
                        <h3 class="fw-bold text-primary mb-0">
                            <i class="fas fa-coins me-2"></i>Aggiorna Spese Aggiuntive
                        </h3>
                        <p class="text-muted mt-2 mb-0">
                            {{ $customer->first_name }} {{ $customer->last_name }} <span
                                class="badge bg-light text-dark ms-2 border">Camera {{ $customer->room }}</span>
                        </p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('customers.expenses.update', $customer->id) }}" method="POST">
                            @csrf

                            <div class="row g-4">
                                @foreach(['spiaggia' => 'fas fa-umbrella-beach', 'bici' => 'fas fa-bicycle', 'pasti' => 'fas fa-utensils', 'bevande' => 'fas fa-glass-martini-alt', 'late_checkout' => 'fas fa-clock', 'altro' => 'fas fa-plus-circle'] as $key => $icon)
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" step="0.01" class="form-control" id="{{ $key }}"
                                                name="expenses[{{ $key }}][amount]" placeholder="Aggiungi importo...">
                                            <label for="{{ $key }}">
                                                <i class="{{ $icon }} me-1 text-muted"></i>
                                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                @if(isset($existingExpenses[$key]))
                                                    <span class="badge bg-info text-white ms-2">Attuale:
                                                        {{ number_format($existingExpenses[$key]->amount, 2, ',', '.') }}€</span>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-success btn-lg shadow-sm rounded-pill">
                                    <i class="fas fa-save me-2"></i>Salva Spese
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