@extends('components.layout', ['manifest' => 'manifest-extras.json', 'hideNavbar' => true])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow border-0">
                <!-- Header -->
                <div class="card-header bg-dark text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('mobile.extras.index') }}" class="btn btn-sm btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div class="text-center">
                            <h5 class="mb-0 fw-bold">Camera {{ $customer->room_number }}</h5>
                            <small>{{ $customer->first_name }} {{ $customer->last_name }}</small>
                        </div>
                        <div style="width: 32px;"></div> <!-- Spacer -->
                    </div>
                </div>

                <div class="card-body p-3">

                    <!-- Add New Expense Section -->
                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Aggiungi Spesa</h6>
                        <form action="{{ route('billing.expenses.update', $customer) }}" method="POST">
                            @csrf

                            <div class="vstack gap-3">
                                <!-- Bevande -->
                                <div class="card border-primary bg-light shadow-sm">
                                    <div class="card-body p-2">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary text-white rounded-circle p-2 me-3">
                                                    <i class="bi bi-cup-straw fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-primary">Bevande</h6>
                                                    <small class="text-muted">Tot: €
                                                        {{ number_format($totals['Bevande'] ?? 0, 2) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <select name="expenses[bevande][type]" class="form-select fw-bold">
                                                    @foreach($beverageTypes as $type)
                                                        <option value="{{ $type }}">{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <input type="number" step="0.50" inputmode="decimal"
                                                        class="form-control fw-bold text-end"
                                                        name="expenses[bevande][amount]" placeholder="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pasti -->
                                <div class="card border-success bg-light shadow-sm">
                                    <div class="card-body p-2 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success text-white rounded-circle p-2 me-3">
                                                <i class="bi bi-egg-fried fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-success">Pasti</h6>
                                                <small class="text-muted">Tot: €
                                                    {{ number_format($totals['Pasti'] ?? 0, 2) }}</small>
                                            </div>
                                        </div>
                                        <div class="input-group input-group-lg w-50">
                                            <input type="number" step="1" inputmode="decimal"
                                                class="form-control fw-bold text-end" name="expenses[pasti][amount]"
                                                placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-4 gap-2">
                                <button type="submit" class="btn btn-dark btn-lg py-3 shadow">
                                    <i class="bi bi-check-lg me-2"></i>CONFERMA E SALVA
                                </button>
                                <a href="{{ route('mobile.extras.index') }}" class="btn btn-outline-secondary py-2">
                                    <i class="bi bi-arrow-left me-2"></i>Torna alla lista
                                </a>
                            </div>
                        </form>
                    </div>

                    <hr class="my-4">

                    <!-- Recent History -->
                    <div class="mb-2">
                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Ultimi Movimenti</h6>
                        @if($recentMovements->isEmpty())
                            <p class="text-muted text-center small py-3">Nessun movimento recente.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($recentMovements as $expense)
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold d-block">{{ $expense->description }}</span>
                                            <small class="text-muted">{{ $expense->created_at->format('d/m H:i') }}</small>
                                        </div>
                                        <span class="fw-bold {{ $expense->amount > 0 ? 'text-dark' : 'text-success' }}">
                                            € {{ number_format($expense->amount, 2) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-center mt-3">
                                <a href="{{ route('billing.expenses', $customer) }}"
                                    class="btn btn-link btn-sm text-decoration-none">
                                    Vedi tutto completo <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Scripts removed as per request to disable auto-redirect --}}
@endsection