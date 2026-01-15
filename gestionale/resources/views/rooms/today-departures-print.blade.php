<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Stato Camere - {{ \Carbon\Carbon::parse($today)->locale('it')->isoFormat('D MMMM YYYY') }}</title>
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

        .check-icon {
            font-size: 1.2em;
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
            <h1>{{ \Carbon\Carbon::parse($today)->locale('it')->isoFormat('D MMMM YYYY') }}</h1>
        </div>

        @if(empty($roomStatus))
            <div class="alert alert-info text-center">
                Nessuna camera in arrivo, in partenza o in fermo per oggi.
            </div>
        @else
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="20%">Numero Camera</th>
                        <th width="25%">In Partenza</th>
                        <th width="25%">In Arrivo</th>
                        <th width="30%">In Fermo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roomStatus as $room => $status)
                        <tr>
                            <td><strong>{{ $room }}</strong></td>
                            <td>
                                @if(!empty($status['departing']))
                                    <i class="fas fa-check check-icon text-danger"></i>
                                @else
                                    <span style="color:#ccc;">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($status['arriving']))
                                    <div>
                                        <i class="fas fa-check check-icon text-success"></i>
                                        @if(isset($status['arriving_pax']) && $status['arriving_pax'] > 0)
                                            <span style="margin-left:8px; font-weight:bold;">
                                                {{ $status['arriving_pax'] }} <i class="fas fa-user-friends small"></i>
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span style="color:#ccc;">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($status['staying']))
                                    <i class="fas fa-check check-icon text-primary"></i>
                                @else
                                    <span style="color:#ccc;">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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