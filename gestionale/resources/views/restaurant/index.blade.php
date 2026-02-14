<x-layout :title="'Ristorante - ' . $date->format('d/m')" bodyId="restaurant-page">

    <h1 class="fw-bold text-primary mb-4 text-center">Ristorante</h1>

    <div class="row mb-4 no-print align-items-center">
        <div class="col-md-6">
            <form action="{{ route('restaurant.index') }}" method="GET" class="d-flex align-items-center gap-2">
                <label for="date" class="fw-bold text-nowrap">Data:</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ $date->format('Y-m-d') }}" onchange="this.form.submit()">
            </form>
        </div>

        <div class="col-md-6 text-end d-none d-md-inline">
            <a href="{{ route('restaurant.print', ['date' => $date->format('Y-m-d')]) }}"
            target="_blank"
            class="btn btn-primary d-none d-md-inline-block">
                <i class="bi bi-printer me-2"></i>Stampa
            </a>
            <button onclick="window.print()" class="btn btn-primarye">
                <i class="bi bi-printer"></i>
            </button>
        </div>
    </div>

    <table class="restaurant-table">
        <thead>
            <tr>
                <th class="col-room">Camera</th>
                <th class="col-pax">Pax</th>
                <th class="col-breakfast">Colazione</th>
                <th class="col-dinner">Cena</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rooms as $roomNumber => $roomName)
                @php
                    $data = $restaurantData[$roomNumber] ?? null;
                @endphp

                @if(!$data || (!$data['hasBreakfast'] && !$data['hasDinner']))
                    @continue
                @endif

                <tr>
                    <td><strong>{{ $roomNumber }}</strong></td>
                    <td>{{ $data['pax'] ?? '-' }}</td>

                    <td>
                        @if($data['hasBreakfast'])
                            <span class="check">X</span>
                        @endif
                    </td>

                    <td>
                        @if($data['hasDinner'])
                            <span class="check">X</span>
                            @if(!empty($data['dinnerNote']))
                                <span class="note">{{ $data['dinnerNote'] }}</span>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr style="background-color: #e0e0e0; font-weight: bold;">
                <td colspan="2" class="text-end">TOTALE PAX:</td>
                <td>{{ $totalBreakfastPax }}</td>
                <td>{{ $totalDinnerPax }}</td>
            </tr>
        </tfoot>
    </table>

</x-layout>
