<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prospetto Spese - {{ $customer->first_name }} {{ $customer->last_name }}</title>
    @vite(['resources/css/print-expenses.css', 'resources/js/print-expenses.js'])
</head>

<body>

    <div class="no-print" style="text-align: right;">
        <button onclick="window.print()" class="btn-print">Stamp Conto</button>
        <a href="{{ route('billing.expenses', $customer) }}"
            style="margin-left: 10px; color: #666; text-decoration: none;">Torna Indietro</a>
    </div>

    <div class="header">
        <h1>Hotel Gemma del Mare</h1>
        <p>Prospetto Spese / Conto Provvisorio</p>
    </div>

    <div class="customer-info">
        <table>
            <tr>
                <td class="label">Cliente:</td>
                <td><strong>{{ $customer->first_name }} {{ $customer->last_name }}</strong></td>
                <td class="label" style="padding-left: 20px;">Periodo:</td>
                <td>{{ date('d/m/Y', strtotime($customer->arrival_date)) }}
                    {{ date('d/m/Y', strtotime($customer->departure_date)) }}
                </td>
                <td class="label" style="padding-left: 20px;">Data:</td>
                <td>{{ now()->format('d/m/Y') }}</td>
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
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $expense->created_at->format('d/m/Y') }}</td>
                    <td>{{ $expense->description }}</td>
                    <td class="amount-col">
                        € {{ number_format($expense->amount, 2, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #999;">Nessuna spesa registrata.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-section">
        <span class="total-label">TOTALE DA SALDARE:</span>
        <span class="total-amount">€ {{ number_format($expenses->sum('amount'), 2, ',', '.') }}</span>
    </div>

    <div class="footer">
        <p>Documento non valido ai fini fiscali come ricevuta o fattura.</p>
        <p>Hotel Gemma del Mare - Via L. da Vinci, 158 - 55045 Pietrasanta (LU) - P.IVA 02659720466</p>
    </div>
</body>

</html>