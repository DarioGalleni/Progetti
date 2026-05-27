@extends('components.layout')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-primary">
                @if(request('q'))
                    Risultati ricerca per: "{{ request('q') }}"
                @else
                    Elenco Ospiti
                @endif
            </h2>
            <p class="text-muted d-md-none small mb-0">
                <i class="bi bi-info-circle me-1"></i>Clicca sul numero di telefono per chiamare, sul link Whatsapp per chattare o sull'email per scrivere.
            </p>
            <p class="text-muted d-none d-md-block small mb-0">
                <i class="bi bi-info-circle me-1"></i>Clicca sull'email per inviare un'email
            </p>
        </div>
    </div>

    @if($customers->isEmpty())
        <div class="alert alert-info text-center">
            Nessun ospite trovato{{ request('q') ? ' per la ricerca effettuata.' : '.' }}
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Ospite</th>
                                <th>Camera</th>
                                <th>Periodo</th>
                                <th>Contatti</th>
                                <th class="text-end pe-4">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">
                                            @if($customer->group_id && $customer->group_name)
                                                {{ $customer->group_name }} ({{ $customer->first_name }})
                                            @else
                                                {{ $customer->first_name }} {{ $customer->last_name }}
                                            @endif
                                        </div>
                                        <div class="small text-muted">
                                            {{ $customer->pax }} pax - {{ $customer->treatment }}
                                            @if($customer->group_id)
                                                <span class="badge" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">Gruppo</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if(!$customer->group_id)
                                            <span class="badge bg-secondary">{{ $customer->room_number }}</span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small">It:
                                            {{ \Carbon\Carbon::parse($customer->arrival_date)->format('d/m/Y') }}</div>
                                        <div class="small">Out:
                                            {{ \Carbon\Carbon::parse($customer->departure_date)->format('d/m/Y') }}</div>
                                    </td>
                                    <td>
                                        @if($customer->phone)
                                            <div class="d-none d-md-block"><i class="bi bi-telephone me-1"></i> {{ $customer->phone }}</div>
                                            <div class="d-md-none">
                                                <a href="tel:{{ $customer->phone }}" class="text-decoration-none d-block mb-1">
                                                    <i class="bi bi-telephone me-1"></i> {{ $customer->phone }}
                                                </a>
                                                <a href="https://wa.me/39{{ str_replace(' ', '', $customer->phone) }}" target="_blank" class="text-success text-decoration-none small">
                                                    <i class="bi bi-whatsapp me-1"></i> Scrivi su Whatsapp
                                                </a>
                                            </div>
                                        @endif
                                        @if($customer->email)
                                            <div class="small mt-1"><a href="mailto:{{ $customer->email }}" class="text-decoration-none"><i class="bi bi-envelope me-1"></i> {{ $customer->email }}</a></div>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Dettagli
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(method_exists($customers, 'links'))
            <div class="mt-4">
                {{-- Desktop View --}}
                <div class="d-none d-md-flex justify-content-center">
                    {{ $customers->links() }}
                </div>
                {{-- Mobile View --}}
                <div class="d-flex d-md-none justify-content-center">
                    {{ $customers->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
