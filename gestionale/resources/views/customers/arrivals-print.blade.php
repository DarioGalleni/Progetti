<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stampa Arrivi - {{ $today->format('d/m/Y') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/css/style.css'])
    <style>
        body {
            background-color: white !important;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container mt-4">
        <h2 class="text-center mb-4 text-success fw-bold">
            <i class="fas fa-suitcase me-2"></i>Arrivi del {{ $today->format('d/m/Y') }}
        </h2>

        <table class="table table-bordered border-success align-middle">
            <thead class="text-center">
                <tr>
                    <th class="py-2">Nominativo</th>
                    <th class="py-2">Camera</th>
                    <th class="py-2">Telefono</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arrivingCustomers->sortBy('room', SORT_NATURAL) as $customer)
                    <tr>
                        <td class="fw-medium">
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </td>
                        <td class="font-monospace fw-bold fs-5">{{ $customer->room }}</td>
                        <td>
                            {{ $customer->phone ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>