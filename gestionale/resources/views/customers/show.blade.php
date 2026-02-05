<x-layout :title="'Dettaglio Cliente: ' . $customer->first_name . ' ' . $customer->last_name">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-custom">
                <div class="card-header bg-white border-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="fw-bold text-primary mb-0">Dettaglio Cliente: {{ $customer->first_name }}
                            {{ $customer->last_name }}
                        </h4>
                        <span class="badge bg-secondary" style="font-size: 0.75rem;">ID: {{ $customer->id }}</span>
                    </div>
                    <div>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary">Torna al Calendario</a>
                    </div>
                </div>
                <div class="card-body">
                    @if($customer->group_id)
                        <div class="alert alert-info d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi bi-people-fill me-2"></i>
                                <strong>Prenotazione di Gruppo:</strong> <a
                                    href="{{ route('groups.show', $customer->group_id) }}"
                                    class="fw-bold text-decoration-none">{{ $customer->group_name }}</a>
                            </div>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-muted mb-3">Informazioni Personali</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Nome:</dt>
                                <dd class="col-sm-8">{{ $customer->first_name }} {{ $customer->last_name }}</dd>

                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8">{{ $customer->email ?: 'N/D' }}</dd>

                                <dt class="col-sm-4">Telefono:</dt>
                                <dd class="col-sm-8">{{ $customer->phone ?: 'N/D' }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-muted mb-3">Dettagli Soggiorno</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Camera:</dt>
                                <dd class="col-sm-8"><strong>{{ $customer->room_number }}</strong> -
                                    {{ config('rooms')[$customer->room_number] ?? '' }}
                                </dd>

                                <dt class="col-sm-4">Periodo:</dt>
                                <dd class="col-sm-8">
                                    Dal {{ \Carbon\Carbon::parse($customer->arrival_date)->format('d/m/Y') }}<br>
                                    Al {{ \Carbon\Carbon::parse($customer->departure_date)->format('d/m/Y') }}
                                </dd>

                                <dt class="col-sm-4">Ospiti:</dt>
                                <dd class="col-sm-8">
                                    {{ $customer->pax }}
                                    @if($customer->under_12_pax > 0)
                                        <small class="text-muted">(di cui {{ $customer->under_12_pax }}
                                            < 12 anni)</small>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Trattamento:</dt>
                                <dd class="col-sm-8">{{ $customer->treatment }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="text-muted mb-3">Dati Finanziari</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-light">
                                            <th>Prezzo Soggiorno</th>
                                            <th>Acconto Versato</th>
                                            <th>Metodo Pagamento</th>
                                            <th>Totale Spese Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fs-5">€ {{ number_format($customer->total_price, 2) }}</td>
                                            <td class="fs-5">€ {{ number_format($customer->deposit, 2) }}</td>
                                            <td>
                                                @if($customer->payment_method == 'booking')
                                                    <span class="badge bg-primary">Booking.com</span>
                                                @else
                                                    <span class="badge bg-success">Contanti / Diretto</span>
                                                @endif
                                            </td>
                                            <td class="fs-5 fw-bold text-danger">€
                                                {{ number_format($customer->expenses->sum('amount'), 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if($customer->notes)
                        <div class="alert alert-secondary mb-4">
                            <strong>Note:</strong> {{ $customer->notes }}
                        </div>
                    @endif

                    <div class="row g-4 mt-4">
                        <!-- Stampa Conto -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold mb-2">Stampa Conto</h5>
                                    <p class="text-muted small mb-3">Riepilogo del conto ad oggi. Non valido come
                                        ricevuta
                                        fiscale</p>
                                    <a href="{{ route('billing.bill.print', $customer) }}" target="_blank"
                                        class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-printer me-2"></i> Stampa Conto
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Stampa Ricevuta -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold mb-2">Stampa Ricevuta</h5>
                                    <p class="text-muted small mb-3">Stampa ricevuta fiscale alla partenza</p>
                                    <a href="{{ route('billing.receipt', $customer) }}" target="_blank"
                                        class="btn btn-success btn-lg w-100">
                                        <i class="bi bi-receipt me-2"></i> Stampa Ricevuta
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Modifica -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold mb-2">Modifica</h5>
                                    <p class="text-muted small mb-3">Modifica dati anagrafici, date, pax, ecc.</p>

                                    @if($customer->group_id)
                                        <button type="button" class="btn btn-warning btn-lg w-100" data-bs-toggle="modal"
                                            data-bs-target="#editGroupModal">
                                            <i class="bi bi-pencil me-2"></i> Modifica
                                        </button>
                                    @else
                                        <a href="{{ route('customers.edit', $customer) }}"
                                            class="btn btn-warning btn-lg w-100">
                                            <i class="bi bi-pencil me-2"></i> Modifica
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Spese Extra -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold mb-2">Spese Extra</h5>
                                    <p class="text-muted small mb-3">Aggiungi consumazioni e servizi in hotel</p>
                                    <a href="{{ route('billing.expenses', $customer) }}"
                                        class="btn btn-info btn-lg w-100 text-white">
                                        <i class="bi bi-cash-coin me-2"></i> Spese Extra
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Elimina -->
                        <div class="col-md-12">
                            <div class="card border-danger shadow-sm">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold mb-2 text-danger">Elimina Prenotazione</h5>
                                    <p class="text-muted small mb-3">Elimina prenotazione dal sistema (azione
                                        irreversibile)</p>

                                    @if($customer->group_id)
                                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal"
                                            data-bs-target="#deleteGroupModal">
                                            <i class="bi bi-trash me-2"></i> Elimina
                                        </button>
                                    @else
                                        <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                            onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-lg">
                                                <i class="bi bi-trash me-2"></i> Elimina
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Modals for Group Actions --}}
    @if($customer->group_id)
        <!-- Edit Modal -->
        <div class="modal fade" id="editGroupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Modifica Prenotazione</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Questa prenotazione fa parte del gruppo <strong>{{ $customer->group_name }}</strong>.</p>
                        <p>Cosa vuoi modificare?</p>
                        <div class="d-grid gap-3 mt-4">
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-person me-2"></i> Solo questa camera ({{ $customer->room_number }})
                            </a>
                            <a href="{{ route('groups.edit', $customer->group_id) }}" class="btn btn-warning btn-lg">
                                <i class="bi bi-people me-2"></i> Tutto il Gruppo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteGroupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold text-danger">Elimina Prenotazione</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Questa prenotazione fa parte del gruppo <strong>{{ $customer->group_name }}</strong>.</p>
                        <p>Cosa vuoi eliminare?</p>
                        <div class="d-grid gap-3 mt-4">
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                onsubmit="return confirm('Sicuro di eliminare solo questa stanza?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-lg w-100">
                                    <i class="bi bi-trash me-2"></i> Solo questa camera ({{ $customer->room_number }})
                                </button>
                            </form>

                            <form action="{{ route('groups.destroy', $customer->group_id) }}" method="POST"
                                onsubmit="return confirm('ATTENZIONE: Stai per eliminare TUTTO il gruppo. Continuare?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-lg w-100">
                                    <i class="bi bi-trash-fill me-2"></i> Tutto il Gruppo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-layout>