<x-layout>
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white border-bottom border-light pt-4 pb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <h4 class="mb-0 text-dark fw-bold">
                        <i class="fas fa-suitcase me-2"></i><span class="text-success">Arrivi</span>
                    </h4>

                    <form method="GET" action="{{ route('customers.arrivals') }}"
                        class="d-flex align-items-center gap-2">
                        <input type="date"
                            class="form-control form-control-lg border-success shadow-sm fw-bold text-success text-center"
                            id="date" name="date" value="{{ $today->format('Y-m-d') }}" onchange="this.form.submit()"
                            style="min-width: 200px;">
                    </form>

                    <div>
                        {{-- Elimina tasto indietro come richiesto --}}
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                @if ($arrivingCustomers->isEmpty())
                    <div class="alert alert-info shadow-sm d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-3 fs-4"></i>
                        <div>Nessun arrivo previsto per questa data.</div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3 text-center">Nominativo</th>
                                    <th class="py-3 text-center">Camera</th>
                                    <th class="py-3 text-center">Telefono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrivingCustomers->sortBy('room', SORT_NATURAL) as $customer)
                                    <tr>
                                        <td class="text-center fw-medium">
                                            {{ $customer->first_name }} {{ $customer->last_name }}
                                        </td>
                                        <td class="text-center font-monospace">{{ $customer->room }}</td>
                                        <td class="text-center">
                                            @if($customer->phone)
                                                {{ $customer->phone }}
                                            @else
                                                <span class="text-muted fst-italic">Non disponibile</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-4 d-flex justify-content-center gap-3">
                    <button
                        onclick="printExternal('{{ route('customers.arrivals.print', ['date' => $today->format('Y-m-d')]) }}')"
                        class="btn btn-success rounded-pill px-4 shadow-sm">
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