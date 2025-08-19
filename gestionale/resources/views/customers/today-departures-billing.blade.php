<x-layout>
    <div class="container mt-5">
        <h1 class="mb-4">Clienti in Partenza Oggi - {{ now()->format('d/m/Y') }}</h1>

        @if($departingCustomers->isEmpty())
            <div class="alert alert-info" role="alert">
                Nessun cliente in partenza oggi.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Camera</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departingCustomers as $customer)
                        <tr>
                            <td>{{ $customer->first_name }}</td>
                            <td>{{ $customer->last_name }}</td>
                            <td>{{ $customer->room }}</td>
                            <td>
                                <a href="{{ route('customers.showBill', $customer->id) }}" class="btn btn-primary">Elabora Conto</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        <div class="mt-4">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Torna alla Home</a>
        </div>
    </div>
</x-layout>