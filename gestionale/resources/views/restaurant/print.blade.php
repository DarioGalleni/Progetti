<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stampa Ristorante {{ $date->format('d/m/Y') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="restaurant-print-page">
    <h1>Ristorante</h1>
    <div class="meta">
        <strong>Data:</strong> {{ $date->format('d/m/Y') }}
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
                <td colspan="2" style="text-align: right;">TOTALE PAX:</td>
                <td>{{ $totalBreakfastPax }}</td>
                <td>{{ $totalDinnerPax }}</td>
            </tr>
        </tfoot>
    </table>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>