<x-layout :title="'Ristorante - ' . $date->format('d/m')">
    <div class="row mb-4 no-print align-items-center">
        <!-- Navigazione Data -->
        <div class="col-md-6 d-flex gap-2 align-items-center">
            <form action="{{ route('restaurant.index') }}" method="GET" class="d-flex gap-2 align-items-center">
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
        <h1>Ristorante - {{ $date->format('d/m') }}</h1>
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

                {{-- Mostra solo se ci sono pasti --}}
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
                <td colspan="2" style="text-align: right;">TOTALE PAX:</td>
                <td>{{ $totalBreakfastPax }}</td>
                <td>{{ $totalDinnerPax }}</td>
            </tr>
        </tfoot>
    </table>

    <x-slot name="scripts">
        @vite(['resources/css/restaurant.css'])
    </x-slot>
</x-layout>