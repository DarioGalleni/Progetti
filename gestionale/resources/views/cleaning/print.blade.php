<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stampa Pulizie {{ $date->format('d/m/Y') }}</title>
    @vite(['resources/css/cleaning-print.css', 'resources/js/cleaning-print.js'])
</head>

<body>
    <h1>Foglio Pulizie</h1>
    <div class="meta">
        <strong>Data:</strong> {{ $date->format('d/m/Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">Camera</th>
                <th style="width: 23%;">Arrivo</th>
                <th style="width: 23%;">Partenza</th>
                <th style="width: 23%;">Fermo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room => $name)
                @php
                    $status = $roomStatus[$room] ?? null;
                    if (empty($status['arrival']) && empty($status['departure']) && empty($status['stayover'])) {
                        continue;
                    }
                @endphp
                <tr>
                    <td><strong>{{ $room }}</strong></td>

                    <td>
                        @if(!empty($status['arrival']))
                            <span class="check">X</span> <span style="font-size: 0.85em;">({{ $status['arrival']->pax }}
                                pax)</span>
                        @endif
                    </td>

                    <td>
                        @if(!empty($status['departure']))
                            <span class="check">X</span>
                        @endif
                    </td>

                    <td>
                        @if(!empty($status['stayover']))
                            <span class="check">X</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>