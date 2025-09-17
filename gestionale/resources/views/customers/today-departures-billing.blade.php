<x-layout>
    <div class="container mt-5">
<h1 class="text-center mb-4">
    Clienti in partenza oggi, {{ \Carbon\Carbon::parse($today)->locale('it')->isoFormat('D MMMM') }}
</h1>

        @if ($departingCustomers->isEmpty())
            <div class="alert alert-info" role="alert">
                Nessun cliente in partenza oggi.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Camera</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departingCustomers->sortBy('room', SORT_NATURAL) as $customer)
                            <tr>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->room }}</td>
                                <td><a href="{{ route('customers.showBill', $customer->id) }}" class="btn btn-sm btn-primary">Elabora Conto</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-4 d-flex justify-content-center">
            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">Torna alla Home</a>
        </div>
    </div>
</x-layout>