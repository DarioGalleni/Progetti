<x-layout>
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <h4 class="mb-0 text-dark fw-bold">
                        <i class="fas fa-suitcase-rolling me-2"></i><span class="text-danger">Partenze</span>
                    </h4>

                    <form method="GET" action="{{ route('customers.todayDeparturesBilling') }}"
                        class="d-flex align-items-center gap-2">
                        <input type="date"
                            class="form-control form-control-lg border-danger shadow-sm fw-bold text-danger text-center"
                            id="date" name="date" value="{{ $today->format('Y-m-d') }}" onchange="this.form.submit()"
                            style="min-width: 200px;">
                    </form>

                    <div>
                        {{-- Elimina tasto indietro come richiesto --}}
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
                                    <th class="py-3 text-center">Nominativo</th>
                                    <th class="py-3 text-center">Camera</th>
                                    <th class="py-3 text-center">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departingCustomers->sortBy('room', SORT_NATURAL) as $customer)
                                    <tr>
                                        <td class="text-center fw-medium">
                                            {{ $customer->first_name }} {{ $customer->last_name }}
                                        </td>
                                        <td class="text-center font-monospace">{{ $customer->room }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('customers.bill', $customer->id) }}"
                                                class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm">
                                                <i class="fas fa-file-invoice-dollar me-1"></i> Elabora Conto
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-4 d-flex justify-content-center gap-3">
                    <button
                        onclick="printExternal('{{ route('customers.departures.print', ['date' => $today->format('Y-m-d')]) }}')"
                        class="btn btn-danger rounded-pill px-4 shadow-sm">
                        <i class="fas fa-print me-2"></i>Stampa
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printExternal(url) {
            var iframe = document.createElement('iframe');
            iframe.style.position = 'fixed';
            iframe.style.right = '0';
            iframe.style.bottom = '0';
            iframe.style.width = '0';
            iframe.style.height = '0';
            iframe.style.border = '0';
            iframe.src = url;
            document.body.appendChild(iframe);
            // The iframe will print itself via its own onload event
        }
    </script>
    </div>
    </div>
    </div>
</x-layout>