<x-layout :title="'Arrivi - ' . $date->format('d/m/Y')">
    <div class="row mb-4 no-print align-items-center">
        <!-- Navigazione Data -->
        <div class="col-md-6 d-flex gap-2 align-items-center">
            <form action="{{ route('arrivals.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                <input type="date" name="date" class="form-control" value="{{ $date->format('Y-m-d') }}"
                    onchange="this.form.submit()">
            </form>
        </div>
        <!-- Stampa -->
        <div class="col-md-6 text-end">
            <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Stampa</button>
        </div>
    </div>

    <div class="text-center mb-3">
        <h1>Arrivi - {{ $date->format('d/m/Y') }}</h1>
    </div>

    @if($arrivals->isEmpty())
        <div class="alert alert-info text-center">Nessun arrivo previsto per questa data.</div>
    @else
        <table class="table table-bordered text-center align-middle" style="border: 1px solid black;">
            <thead class="table-light">
                <tr>
                    <th style="width: 20%;">Camera</th>
                    <th>Nominativo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arrivals as $customer)
                    <tr>
                        <td class="fw-bold fs-5">{{ $customer->room_number }}</td>
                        <td class="fs-5">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <x-slot name="scripts">
        {{-- CSS Inline per stampa veloce simile a restaurant senza file separato se semplice --}}
        <style>
            @media print {
                .no-print {
                    display: none !important;
                }

                .navbar {
                    display: none !important;
                }

                .container-fluid {
                    margin: 0;
                    padding: 0;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th,
                td {
                    border: 1px solid black !important;
                    padding: 10px;
                }
            }
        </style>
    </x-slot>
</x-layout>