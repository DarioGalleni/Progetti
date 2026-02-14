<x-layout :title="'Partenze - ' . $date->format('d/m/Y')" bodyId="reception-page">
    <h1 class="fw-bold text-primary mb-4 text-center">Partenze</h1>

    <div class="row mb-4 no-print align-items-center">
        <div class="col-md-6">
            <form action="{{ route('departures.index') }}" method="GET" class="d-flex align-items-center gap-2">
                <label for="date" class="fw-bold text-nowrap">Data:</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ $date->format('Y-m-d') }}" onchange="this.form.submit()">
            </form>
        </div>
        <div class="col-md-6 text-end d-none d-md-inline">
            <button onclick="window.print()" class="btn btn-primary d-none d-md-inline-block">
                <i class="bi bi-printer me-2"></i>Stampa
            </button>
            <button onclick="window.print()" class="btn btn-primary d-md-none">
                <i class="bi bi-printer"></i>
            </button>
        </div>
    </div>

    @if($departures->isEmpty())
        <div class="alert alert-info text-center">Nessuna partenza prevista per questa data.</div>
    @else
        <table class="table table-bordered text-center align-middle border-black">
            <thead class="table-light">
                <tr>
                    <th style="width: 20%;">Camera</th>
                    <th>Nominativo</th>
                    <th class="no-print" style="width: 15%;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departures as $customer)
                    <tr>
                        <td class="fw-bold fs-5">{{ $customer->room_number }}</td>
                        <td class="fs-5">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        <td class="no-print">
                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i> Vedi
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layout>