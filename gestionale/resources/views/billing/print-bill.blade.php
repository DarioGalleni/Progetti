<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conto Ospite - {{ $customer->first_name }} {{ $customer->last_name }}</title>
    @vite(['resources/css/print-expenses.css', 'resources/js/print-expenses.js'])
</head>

<body>

    <div class="header">
        <h1>Hotel Gemma del Mare</h1>
        <p>Conto Ospite / Riepilogo</p>
        <h3>Aggiornato al: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h3>
    </div>

    <div class="customer-info">
        <table>
            <tr>
                <td class="label">Cliente:</td>
                <td><strong>{{ $customer->first_name }} {{ $customer->last_name }}</strong></td>
                <td class="label" style="padding-left: 20px;">Camera:</td>
                <td><strong>{{ $customer->room_number }}</strong></td>
                <td class="label" style="padding-left: 20px;">Ospiti:</td>
                <td>{{ $customer->pax }}</td>
            </tr>
            <tr>
                <td class="label">Arrivo:</td>
                <td>{{ \Carbon\Carbon::parse($customer->arrival_date)->format('d/m/Y') }}</td>
                <td class="label" style="padding-left: 20px;">Partenza:</td>
                <td>{{ \Carbon\Carbon::parse($customer->departure_date)->format('d/m/Y') }}</td>
                <td class="label" style="padding-left: 20px;">Notti:</td>
                <td>{{ $days }}</td>
            </tr>
        </table>
    </div>

    <table class="expenses-table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrizione</th>
                <th class="amount-col">Importo</th>
            </tr>
        </thead>
        <tbody>
            {{-- Soggiorno --}}
            <tr>
                <td></td>
                <td>
                    <strong>Soggiorno</strong><br>
                    <span style="font-size: 0.9em; color: #555;">
                        {{ $customer->treatment }} - Dal {{ \Carbon\Carbon::parse($customer->arrival_date)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($customer->departure_date)->format('d/m/Y') }}
                    </span>
                </td>
                <td class="amount-col">€ {{ number_format($customer->total_price, 2, ',', '.') }}</td>
            </tr>

            {{-- Spese Extra --}}
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->created_at->format('d/m/Y') }}</td>
                    <td>{{ $expense->description }}</td>
                    <td class="amount-col">€ {{ number_format($expense->amount, 2, ',', '.') }}</td>
                </tr>
            @endforeach

            {{-- Imposta di Soggiorno --}}
            <tr>
                <td></td>
                <td>
                    <strong>Imposta di Soggiorno</strong><br>
                    <span style="font-size: 0.9em; color: #555;">
                        {{ $taxablePax }} ospiti &times; € 1,50 &times; {{ $taxableDays }} notti
                        @if($taxableDays < $days) (max 7) @endif
                    </span>
                </td>
                <td class="amount-col">€ {{ number_format($touristTax, 2, ',', '.') }}</td>
            </tr>

            {{-- Acconto --}}
            @if($customer->deposit > 0)
            <tr>
                <td></td>
                <td>Acconto versato</td>
                <td class="amount-col" style="color: #dc3545;">- € {{ number_format($customer->deposit, 2, ',', '.') }}</td>
            </tr>
            @endif

        </tbody>
    </table>

    <div class="total-section">
        <span class="total-label">TOTALE DA PAGARE:</span>
        <span class="total-amount">€ {{ number_format($grandTotal, 2, ',', '.') }}</span>
    </div>

    <div class="footer">
        <p>Non valido ai fini fiscali.</p>
        <p>Hotel Gemma del Mare - Via L. da Vinci, 158 - 55045 Pietrasanta (LU) - P.IVA 02659720466</p>
    </div>
</body>

</html>