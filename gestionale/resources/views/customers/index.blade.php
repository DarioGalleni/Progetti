<x-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Risultati della Ricerca</h1>
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Torna al Calendario</a>
        </div>

        @if ($customers->isEmpty())
            <div class="alert alert-warning" role="alert">
                Nessun cliente trovato per "{{ $query }}".
            </div>
        @else
            <p class="text-muted">Trovati {{ $customers->count() }} risultati per "{{ $query }}":</p>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->phone ?? 'N/A' }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-primary btn-sm">Dettagli</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>