<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ristorante - {{ $selectedDate->locale('it')->isoFormat('D MMMM YYYY') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: #fff;
        }

        .print-container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #336633;
        }

        .hotel-logo {
            font-size: 24px;
            font-weight: bold;
            color: #336633;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
            color: #000;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-custom th,
        .table-custom td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .table-custom th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .footer-totals {
            margin-top: 20px;
            border-top: 2px solid #333;
            padding-top: 15px;
            display: flex;
            justify-content: flex-end;
            gap: 30px;
            font-size: 1.1em;
            font-weight: bold;
        }

        /* Print specific styles */
        @media print {
            @page {
                margin: 1cm;
            }

            body {
                background: white;
            }

            .print-btn {
                display: none !important;
            }

            .table-custom th {
                background-color: #eee !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="print-container">
        <div class="header">
            <h1>Ristorante - {{ $selectedDate->locale('it')->isoFormat('D MMMM YYYY') }}</h1>
        </div>

        @php
            $totalBreakfast = 0;
            $totalDinner = 0;
            foreach ($roomData as $data) {
                if ($data['breakfast']) {
                    $totalBreakfast += $data['number_of_people'];
                }
                if ($data['dinner']) {
                    if (isset($data['arriving_people'])) {
                        $totalDinner += $data['arriving_people'];
                    } elseif ($data['status'] === 'arriving') {
                        $totalDinner += $data['number_of_people'];
                    } else {
                        $totalDinner += $data['number_of_people'];
                    }
                }
            }
        @endphp

        @if(empty($roomData))
            <div class="alert alert-info text-center">
                Nessun ospite presente per la data selezionata.
            </div>
        @else
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="20%">Camera</th>
                        <th width="20%">Pax</th>
                        <th width="30%">Colazione</th>
                        <th width="30%">Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roomData as $room => $data)
                        <tr>
                            <td><strong>{{ $room }}</strong></td>
                            <td>
                                <strong>{{ $data['number_of_people'] }}</strong>
                                @if(isset($data['arriving_people']))
                                    <span style="color:#28a745; margin-left:5px; font-size:0.9em;">
                                        <i class="fas fa-arrow-left"></i> {{ $data['arriving_people'] }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($data['breakfast'])
                                    <i class="fas fa-check text-success"></i>
                                @else
                                    <span style="color:#ccc;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($data['dinner'])
                                    <div>
                                        <i class="fas fa-check text-success"></i>
                                        @if($data['status'] === 'arriving')
                                            <span
                                                style="display:inline-block; border:1px solid #28a745; color:#28a745; border-radius:10px; padding:2px 8px; font-size:0.8em; margin-left:5px;">
                                                In Arrivo: {{ $data['number_of_people'] }}
                                            </span>
                                        @elseif($data['status'] === 'departing_arriving' && isset($data['arriving_people']))
                                            <span
                                                style="display:inline-block; border:1px solid #28a745; color:#28a745; border-radius:10px; padding:2px 8px; font-size:0.8em; margin-left:5px;">
                                                In Arrivo: {{ $data['arriving_people'] }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span style="color:#ccc;">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="footer-totals">
                <div>Totale Colazioni: {{ $totalBreakfast }}</div>
                <div>Totale Cene: {{ $totalDinner }}</div>
            </div>
        @endif

        <div class="text-center mt-5 print-btn">
            <button onclick="window.print()" class="btn btn-primary btn-lg">
                <i class="fas fa-print me-2"></i>Stampa
            </button>
        </div>
    </div>
    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>