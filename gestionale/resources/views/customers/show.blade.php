<x-layout>
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-primary fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Dettagli Prenotazione
                    </h4>
                    <span class="badge bg-light text-dark border p-2">
                        <i class="fas fa-hashtag me-1"></i>ID: {{ $customer->id }}
                    </span>
                </div>
                <h5 class="mt-2 text-dark fw-bold">{{ $customer->first_name }} {{ $customer->last_name }}</h5>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Info Cliente --}}
                    <div class="col-md-6">
                        <div class="h-100 p-4 bg-light rounded-3 border-0">
                            <h5 class="text-secondary fw-bold mb-3 border-bottom pb-2">
                                <i class="fas fa-user me-2"></i>Informazioni Cliente
                            </h5>
                            <ul class="list-unstyled mb-0 d-grid gap-2">
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Nome:</span>
                                    <span class="fw-bold">{{ $customer->first_name }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Cognome:</span>
                                    <span class="fw-bold">{{ $customer->last_name }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Email:</span>
                                    <span class="fw-bold">{{ $customer->email }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Telefono:</span>
                                    <span class="fw-bold">{{ $customer->phone ?? 'N/A' }}</span>
                                </li>
                                @if($customer->is_booking)
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Origine:</span>
                                        <span class="badge bg-primary">Booking.com</span>
                                    </li>
                                @endif
                                @if($customer->is_cash_payment)
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Pagamento:</span>
                                        <span class="badge bg-success">Contanti</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- Dettagli Soggiorno --}}
                    <div class="col-md-6">
                        <div class="h-100 p-4 bg-light rounded-3 border-0">
                            <h5 class="text-secondary fw-bold mb-3 border-bottom pb-2">
                                <i class="fas fa-bed me-2"></i>Dettagli Soggiorno
                            </h5>
                            <ul class="list-unstyled mb-0 d-grid gap-2">
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Camera:</span>
                                    <span class="badge bg-primary fs-6">{{ $customer->room }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Arrivo:</span>
                                    <span class="fw-bold">{{ date('d/m/Y', strtotime($customer->arrival_date)) }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Partenza:</span>
                                    <span
                                        class="fw-bold">{{ date('d/m/Y', strtotime($customer->departure_date)) }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Trattamento:</span>
                                    <span class="fw-bold">{{ $customer->treatment }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span class="text-muted">Persone:</span>
                                    <span class="fw-bold">{{ $customer->number_of_people }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Dati Finanziari --}}
                    <div class="col-md-6">
                        <div class="h-100 p-4 bg-light rounded-3 border-0">
                            <h5 class="text-secondary fw-bold mb-3 border-bottom pb-2">
                                <i class="fas fa-euro-sign me-2"></i>Dati Finanziari
                            </h5>
                            <ul class="list-unstyled mb-0 d-grid gap-2">
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Costo Totale:</span>
                                    <span
                                        class="fs-5 fw-bold text-success">{{ number_format($customer->total_stay_cost, 2, ',', '.') }}
                                        €</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Acconto:</span>
                                    <span class="fw-bold">{{ number_format($customer->down_payment, 2, ',', '.') }}
                                        €</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Spese Aggiuntive --}}
                    <div class="col-md-6">
                        <div class="h-100 p-4 bg-light rounded-3 border-0">
                            <h5 class="text-secondary fw-bold mb-3 border-bottom pb-2">
                                <i class="fas fa-receipt me-2"></i>Spese Aggiuntive
                            </h5>
                            @if ($customer->expenses->isNotEmpty())
                                <ul class="list-unstyled mb-0 d-grid gap-2">
                                    @foreach ($customer->expenses as $expense)
                                        <li class="d-flex justify-content-between border-bottom border-light pb-1">
                                            <span>{{ ucfirst($expense->expense_type) }}</span>
                                            <span class="fw-bold">{{ number_format($expense->amount, 2, ',', '.') }} €</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center text-muted fst-italic py-3">
                                    Nessuna spesa aggiuntiva.
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($customer->additional_notes)
                        <div class="col-md-12">
                            <div class="h-100 p-4 bg-light rounded-3 border-0">
                                <h5 class="text-secondary fw-bold mb-3 border-bottom pb-2">
                                    <i class="fas fa-sticky-note me-2"></i>Note Aggiuntive
                                </h5>
                                <p class="mb-0 text-muted">{{ $customer->additional_notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 pt-3 border-top gap-3">
                    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Indietro
                    </a>

                    <div class="d-flex gap-2">
                        @if($customer->is_group)
                            {{-- Azioni Gruppo --}}
                            <div class="btn-group shadow-sm">
                                <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-edit me-1"></i>Modifica
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('customers.edit', $customer->id) }}">Modifica Solo Questa
                                            Camera</a></li>
                                    <li><a class="dropdown-item" href="{{ route('groups.edit', $customer->id) }}">Modifica
                                            Tutto il Gruppo</a></li>
                                </ul>
                            </div>

                            <a href="{{ route('customers.expenses.show', $customer->id) }}"
                                class="btn btn-info text-white shadow-sm">
                                <i class="fas fa-coins me-1"></i>Spese
                            </a>

                            <div class="btn-group shadow-sm">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-trash-alt me-1"></i>Elimina
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                            class="d-inline w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                onclick="return confirm('Sei sicuro di voler eliminare SOLO questa camera?');">
                                                Elimina Solo Questa Camera
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('groups.destroy', $customer->id) }}" method="POST"
                                            class="d-inline w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger fw-bold"
                                                onclick="return confirm('ATTENZIONE: Stai per eliminare TUTTO il gruppo e tutte le camere associate. Sei sicuro?');">
                                                Elimina Tutto il Gruppo
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            {{-- Azioni Cliente Singolo --}}
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning shadow-sm">
                                <i class="fas fa-edit me-1"></i>Modifica
                            </a>
                            <a href="{{ route('customers.expenses.show', $customer->id) }}"
                                class="btn btn-info text-white shadow-sm">
                                <i class="fas fa-coins me-1"></i>Spese
                            </a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger shadow-sm">
                                    <i class="fas fa-trash-alt me-1"></i>Elimina
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>