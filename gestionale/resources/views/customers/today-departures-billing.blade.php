<x-layout>
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <h4 class="mb-0 text-dark fw-bold">
                        <i class="fas fa-plane-departure me-2"></i><span class="text-primary">Partenze</span>
                    </h4>

                    <form method="GET" action="{{ route('customers.todayDeparturesBilling') }}"
                        class="d-flex align-items-center gap-2">
                        <input type="date"
                            class="form-control form-control-lg border-primary shadow-sm fw-bold text-primary" id="date"
                            name="date" value="{{ $today->format('Y-m-d') }}" onchange="this.form.submit()"
                            style="min-width: 200px;">
                    </form>

                    <div>
                        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Indietro
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                @if ($departingCustomers->isEmpty())
                    <div class="alert alert-info shadow-sm d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-3 fs-4"></i>
                        <div>Nessun cliente in partenza oggi.</div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3 ps-3">Nome</th>
                                    <th class="py-3">Cognome</th>
                                    <th class="py-3 text-center">Camera</th>
                                    <th class="py-3 text-end pe-3">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departingCustomers->sortBy('room', SORT_NATURAL) as $customer)
                                    <tr>
                                        <td class="ps-3 fw-medium">{{ $customer->first_name }}</td>
                                        <td class="fw-medium">{{ $customer->last_name }}</td>
                                        <td class="text-center font-monospace">{{ $customer->room }}</td>
                                        <td class="text-end pe-3">
                                            <a href="{{ route('customers.bill', $customer->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                                <i class="fas fa-file-invoice-dollar me-1"></i> Elabora Conto
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-4 d-flex justify-content-center">
                    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-home me-2"></i>Torna alla Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>