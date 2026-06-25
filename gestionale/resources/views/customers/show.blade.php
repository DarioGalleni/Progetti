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
                    <div class="ms-2 ms-md-0">
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary">Calendario</a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Messaggio di Successo --}}
                    @if(session('success'))
                        <div class="alert alert-success mb-4 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mb-4 text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- =============================== -->
                    <!-- INIZIO VISTA GRUPPI             -->
                    <!-- =============================== -->
                    @if($customer->group_id)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-4">
                                        <h5 class="text-muted mb-4 text-center">Dettagli</h5>
                                        
                                        <div class="row text-center g-3 row-cols-2 row-cols-md-5">
                                            <div class="col">
                                                <div class="p-3 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center align-items-center">
                                                    <small class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.70rem;">hai selezionato la camera</small>
                                                    <i class="bi bi-door-closed text-primary" style="font-size: 2rem;"></i>
                                                    <h4 class="mt-2 mb-0 fw-bold">{{ $customer->room_number }}</h4>
                                                    <small class="text-muted mt-1">{{ config('rooms')[$customer->room_number] ?? 'Nessuna' }}</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col">
                                                <div class="p-3 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center align-items-center">
                                                    <small class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.70rem;">Totale</small>
                                                    <i class="bi bi-tags-fill text-primary" style="font-size: 2rem;"></i>
                                                    <h4 class="mt-2 mb-0 fw-bold">{{ \App\Models\Customer::where('group_id', $customer->group_id)->count() }}</h4>
                                                    <small class="text-muted mt-1">Camere Assegnate al Gruppo</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col">
                                                <div class="p-3 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center align-items-center">
                                                    <small class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.70rem;">Pax Totali</small>
                                                    <i class="bi bi-person-lines-fill text-primary" style="font-size: 2rem;"></i>
                                                    <h4 class="mt-2 mb-0 fw-bold">{{ \App\Models\Customer::where('group_id', $customer->group_id)->sum('pax') }}</h4>
                                                    <small class="text-muted mt-1">Ospiti nel Gruppo</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col">
                                                <div class="p-3 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center align-items-center">
                                                    <small class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.70rem;">Check-in</small>
                                                    <i class="bi bi-calendar-check text-success" style="font-size: 2rem;"></i>
                                                    <h4 class="mt-2 mb-0 fw-bold">{{ \Carbon\Carbon::parse($customer->arrival_date)->format('d/m/Y') }}</h4>
                                                    <small class="text-muted mt-1">Data Arrivo</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col">
                                                <div class="p-3 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center align-items-center">
                                                    <small class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.70rem;">Check-out</small>
                                                    <i class="bi bi-calendar-x text-danger" style="font-size: 2rem;"></i>
                                                    <h4 class="mt-2 mb-0 fw-bold">{{ \Carbon\Carbon::parse($customer->departure_date)->format('d/m/Y') }}</h4>
                                                    <small class="text-muted mt-1">Data Partenza</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @php
                                            $nights = \Carbon\Carbon::parse($customer->arrival_date)->diffInDays(\Carbon\Carbon::parse($customer->departure_date));
                                        @endphp
                                        
                                        <div class="text-center mt-4">
                                            <span class="badge bg-info" style="font-size: 1rem; padding: 0.5rem 1rem;">
                                                <i class="bi bi-moon-stars"></i> {{ $nights }} {{ $nights == 1 ? 'Notte' : 'Notti' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($customer->notes)
                            <div class="alert alert-secondary mb-4">
                                <strong>Note:</strong> {{ $customer->notes }}
                            </div>
                        @endif
                    <!-- =============================== -->
                    <!-- FINE VISTA GRUPPI               -->
                    <!-- =============================== -->
                    @else
                    <!-- =============================== -->
                    <!-- INIZIO VISTA CAMERE SINGOLE     -->
                    <!-- =============================== -->
                        <div class="row mb-4 text-center text-md-start">
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
                                                minori di 12 anni)</small>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Trattamento:</dt>
                                    <dd class="col-sm-8">{{ $customer->treatment }}</dd>

                                    <dt class="col-sm-4">Registrato:</dt>
                                    <dd class="col-sm-8">
                                        @if($customer->registrato)
                                            <span>Sì</span>
                                        @else
                                            <span>No</span>
                                        @endif
                                    </dd>
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
                                            <tr class="text-center align-middle">
                                                <td class="fs-5">€ {{ number_format($customer->total_price, 2) }}</td>
                                                <td class="fs-5">€ {{ number_format($customer->deposit, 2) }}</td>
                                                <td>
                                                    @if($customer->payment_method == 'booking')
                                                        <span class="badge bg-primary">Booking.com</span>
                                                    @elseif($customer->payment_method == 'Non Selezionato')
                                                        <span class="badge bg-secondary">Non Selezionato</span>
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
                    <!-- =============================== -->
                    <!-- FINE VISTA CAMERE SINGOLE       -->
                    <!-- =============================== -->
                    @endif

                    <div class="row g-4 mt-4">
                        @if(!$customer->group_id)
                            {{-- Stampa Conto --}}
                            <div class="col-md-6 d-none d-md-block">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center p-4 d-flex flex-column">
                                        <h5 class="fw-bold mb-2">Stampa Conto</h5>
                                        <p class="text-muted small mb-3">Riepilogo del conto ad oggi. Non valido come ricevuta fiscale</p>
                                        <a href="{{ route('billing.bill.print', $customer) }}" target="_blank" class="btn btn-primary btn-lg w-100 mt-auto">
                                            <i class="bi bi-printer me-2"></i> Stampa Conto
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Stampa Ricevuta --}}
                            <div class="col-md-6 d-none d-md-block">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center p-4 d-flex flex-column">
                                        <h5 class="fw-bold mb-2">Stampa Ricevuta</h5>
                                        <p class="text-muted small mb-3">Stampa ricevuta fiscale alla partenza</p>
                                        <a href="{{ route('billing.receipt', $customer) }}" target="_blank" class="btn btn-success btn-lg w-100 mt-auto">
                                            <i class="bi bi-receipt me-2"></i> Stampa Ricevuta
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Modifica --}}
                        <div class="col-md-{{ $customer->group_id ? '12' : '6' }}">
                            <div class="card {{ $customer->group_id ? 'border-warning' : 'border-0' }} shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold mb-2 {{ $customer->group_id ? 'text-warning' : '' }}">Modifica Prenotazione</h5>
                                    <p class="text-muted small mb-3">Modifica dati anagrafici, date, pax, ecc.</p>

                                    @if($customer->group_id)
                                        <button type="button" class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#editGroupModal">
                                            <i class="bi bi-pencil me-2"></i> Modifica
                                        </button>
                                    @else
                                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-lg w-100">
                                            <i class="bi bi-pencil me-2"></i> Modifica
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(!$customer->group_id)
                            {{-- Spese Extra --}}
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center p-4">
                                        <h5 class="fw-bold mb-2">Spese Extra</h5>
                                        <p class="text-muted small mb-3">Aggiungi consumazioni e servizi in hotel</p>
                                        <a href="{{ route('billing.expenses', $customer) }}" class="btn btn-info btn-lg w-100 text-white">
                                            <i class="bi bi-cash-coin me-2"></i> Spese Extra
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Elimina --}}
                        <div class="col-md-12">
                            <div class="card border-danger shadow-sm">
                                <div class="card-body text-center p-4">
                                    <h5 class="fw-bold mb-2 text-danger">Elimina Prenotazione</h5>
                                    <p class="text-muted small mb-3">Elimina prenotazione dal sistema (azione irreversibile)</p>

                                    @if($customer->group_id)
                                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteGroupModal">
                                            <i class="bi bi-trash me-2"></i> Elimina
                                        </button>
                                    @else
                                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
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