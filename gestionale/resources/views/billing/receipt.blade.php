<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ricevuta Fiscale - {{ $customer->first_name }} {{ $customer->last_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/receipt.css', 'resources/js/receipt.js'])
</head>

<body>
    <div class="container py-5">
        <div class="invoice-box">
            <!-- Intestazione con Logo e Info Hotel -->
            <div class="invoice-header">
                <div class="hotel-info">
                    <div class="hotel-logo">
                        <i class="far fa-gem"></i> Gemma del Mare
                    </div>
                    <div class="hotel-address">
                        <strong>Via Leonardo da Vinci, 158</strong><br>
                        55045 Marina di Pietrasanta (LU) - Italia<br>
                        Tel: +39 0584 840371<br>
                        Email: info@gemmadelmare.com
                    </div>
                </div>
                <div class="invoice-title">
                    <h1>Ricevuta Fiscale</h1>
                    <small>Emesso il {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</small>
                    <br>
                    <small id="receipt-number">Ricevuta fiscale N: </small>
                </div>
            </div>

            <!-- Dati Cliente -->
            <div class="kv-row">
                <span class="kv-label">Cliente:</span>
                <span class="kv-value">{{ $customer->first_name }} {{ $customer->last_name }}</span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Camera:</span>
                <span class="kv-value">{{ $customer->room_number }}</span>
            </div>

            <!-- Informazioni Anagrafiche -->
            <div class="section-title">Informazioni Anagrafiche</div>
            <div class="kv-row">
                <span class="kv-label">Email:</span>
                <span class="kv-value">{{ $customer->email ?? '-' }}</span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Telefono:</span>
                <span class="kv-value">{{ $customer->phone ?? '-' }}</span>
            </div>

            <!-- Permanenza -->
            <div class="section-title">Permanenza</div>
            <div class="kv-row">
                <span class="kv-label">Arrivo:</span>
                <span class="kv-value">{{ \Carbon\Carbon::parse($customer->arrival_date)->format('d/m/Y') }}</span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Partenza:</span>
                <span class="kv-value">{{ \Carbon\Carbon::parse($customer->departure_date)->format('d/m/Y') }}</span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Numero notti:</span>
                <span class="kv-value">
                    {{ \Carbon\Carbon::parse($customer->arrival_date)->diffInDays(\Carbon\Carbon::parse($customer->departure_date)) }}
                </span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Numero persone:</span>
                <span class="kv-value">{{ $customer->pax }}</span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Trattamento:</span>
                <span class="kv-value">{{ $customer->treatment }}</span>
            </div>

            <!-- Riepilogo Costi -->
            <div class="section-title">Riepilogo Costi</div>
            <div class="kv-row">
                <span class="kv-label">Costo soggiorno:</span>
                <span class="kv-value">
                    {{ number_format($customer->total_price ?? 0, 2, ',', '.') }} €
                    @if($customer->payment_method == 'booking')
                        <span style="font-weight: normal; font-size: 0.9em; margin-left: 5px;">(pagata online)</span>
                    @endif
                </span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Imposta di soggiorno:</span>
                <span class="kv-value">{{ number_format($touristTax ?? 0, 2, ',', '.') }} €</span>
            </div>

            @if(!empty($extrasTotal) && $extrasTotal > 0)
                <div class="kv-row" style="background-color: #f9fff9;">
                    <span class="kv-label">Spese Aggiuntive:</span>
                    <span class="kv-value">{{ number_format($extrasTotal, 2, ',', '.') }} €</span>
                </div>
                <div style="padding-left: 15px; font-size: 0.9em; color: #666;">
                    @php
                        // Group expenses by category
                        $beverageTypes = ['Vino', 'Acqua', 'Bar', 'Bibite', 'Amari', 'Aperitivi', 'Bevande'];
                        $groupedExpenses = [];
                        $beverageTotal = 0;

                        foreach ($customer->expenses as $expense) {
                            if (in_array($expense->description, $beverageTypes)) {
                                $beverageTotal += $expense->amount;
                            } else {
                                if (!isset($groupedExpenses[$expense->description])) {
                                    $groupedExpenses[$expense->description] = 0;
                                }
                                $groupedExpenses[$expense->description] += $expense->amount;
                            }
                        }

                        // Add beverage total to grouped expenses if exists
                        if ($beverageTotal > 0) {
                            $groupedExpenses = ['Bevande' => $beverageTotal] + $groupedExpenses;
                        }
                    @endphp

                    @foreach($groupedExpenses as $description => $amount)
                        <div class="kv-row">
                            <span>• {{ ucfirst(str_replace('_', ' ', $description)) }}</span>
                            <span>{{ number_format($amount, 2, ',', '.') }} €</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="kv-row" style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 10px;">
                <span class="kv-label"><strong>Totale Complessivo:</strong></span>
                <span class="kv-value">{{ number_format($grandTotal ?? 0, 2, ',', '.') }} €</span>
            </div>
            <div class="kv-row text-danger">
                <span class="kv-label">Acconto versato:</span>
                <span class="kv-value">- {{ number_format($customer->deposit ?? 0, 2, ',', '.') }} €</span>
            </div>

            <div class="total-row">
                <span>Totale Pagato:</span>
                <span>{{ number_format($grandTotal - ($customer->deposit ?? 0), 2, ',', '.') }} €</span>
            </div>

            <!-- Footer -->
            <div class="footer-note">
                <p class="mb-1">Grazie per aver scelto Hotel Gemma del Mare</p>
                <p class="mb-0">www.gemmadelmare.com</p>
            </div>
        </div>
    </div>

    <!-- Font Awesome per le icone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>

</html>