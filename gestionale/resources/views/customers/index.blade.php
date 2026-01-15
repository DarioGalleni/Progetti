<x-layout>
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-primary mb-0">
                        <i class="fas fa-search me-2"></i>Risultati della Ricerca
                    </h2>
                    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Torna al Calendario
                    </a>
                </div>

                @if ($customers->isEmpty())
                    <div class="alert alert-warning shadow-sm border-0 d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                        <div>
                            Nessun cliente trovato per "<strong>{{ $query }}</strong>".
                        </div>
                    </div>
                @else
                    <p class="text-muted mb-3">
                        Trovati <span class="fw-bold text-dark">{{ $customers->count() }}</span> risultati per
                        "<strong>{{ $query }}</strong>":
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3 ps-3">Nome</th>
                                    <th class="py-3">Cognome</th>
                                    <th class="py-3">Telefono</th>
                                    <th class="py-3">Email</th>
                                    <th class="py-3 text-end pe-3">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="ps-3 fw-medium">{{ $customer->first_name }}</td>
                                        <td class="fw-medium">{{ $customer->last_name }}</td>
                                        <td>{{ $customer->phone ?? 'N/A' }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td class="text-end pe-3">
                                            <a href="{{ route('customers.show', $customer->id) }}"
                                                class="btn btn-primary btn-sm shadow-sm rounded-pill px-3">
                                                Dettagli <i class="fas fa-chevron-right ms-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>