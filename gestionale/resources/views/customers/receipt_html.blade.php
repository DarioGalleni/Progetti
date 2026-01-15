<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ricevuta Fiscale - {{ $customer->first_name }} {{ $customer->last_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #336633;
        }

        .hotel-info {
            flex: 1;
        }

        .hotel-logo {
            font-size: 28px;
            font-weight: bold;
            color: #336633;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hotel-address {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
        }

        .invoice-title {
            text-align: right;
            flex: 0 0 auto;
        }

        .invoice-title h1 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .invoice-title small {
            color: #999;
            font-size: 12px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
            margin-top: 30px;
            color: #333;
        }

        .kv-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f9f9f9;
        }

        .kv-row:last-child {
            border-bottom: none;
        }

        .kv-label {
            font-weight: 500;
        }

        .kv-value {
            font-weight: 600;
            color: #000;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            font-size: 20px;
            font-weight: bold;
            border-top: 2px solid #333;
            margin-top: 20px;
        }

        .footer-note {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .print-btn {
            display: block;
        }

        /* Override Bootstrap per tema */
        .btn-primary {
            background-color: #336633;
            border-color: #336633;
        }

        .btn-primary:hover {
            background-color: #264d26;
            border-color: #264d26;
        }

        @media print {
            @page {
                margin: 1cm;
                size: auto;
            }

            body {
                visibility: hidden;
                margin: 0;
                padding: 0;
                background-color: #fff;
            }

            .invoice-box {
                visibility: visible;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
                font-size: 12px;
                line-height: 1.4;
            }

            .container {
                width: 100%;
                max-width: 100%;
                padding: 0;
                margin: 0;
            }

            .invoice-header {
                margin-bottom: 15px;
                padding-bottom: 10px;
            }

            .hotel-logo {
                font-size: 20px;
            }

            .invoice-title h1 {
                font-size: 24px;
            }

            .section-title {
                margin-top: 15px;
                margin-bottom: 5px;
                padding-bottom: 5px;
                font-size: 14px;
            }

            .kv-row {
                padding: 2px 0;
            }

            .total-row {
                font-size: 16px;
                margin-top: 15px;
                padding: 10px 0;
            }

            .footer-note {
                margin-top: 20px;
                padding-top: 10px;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
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
                <span class="kv-value">{{ $customer->room }}</span>
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
                <span class="kv-value">{{ $customer->number_of_people }}</span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Trattamento:</span>
                <span class="kv-value">{{ $customer->treatment }}</span>
            </div>

            <!-- Riepilogo Costi -->
            <div class="section-title">Riepilogo Costi</div>
            <div class="kv-row">
                <span class="kv-label">Costo soggiorno:</span>
                <span class="kv-value">{{ number_format($customer->total_stay_cost ?? 0, 2, ',', '.') }} €</span>
            </div>
            <div class="kv-row">
                <span class="kv-label">Imposta di soggiorno:</span>
                <span class="kv-value">{{ number_format($cityTax ?? 0, 2, ',', '.') }} €</span>
            </div>

            @if(!empty($additionalExpenses) && $additionalExpenses > 0)
                <div class="kv-row" style="background-color: #f9fff9;">
                    <span class="kv-label">Spese Aggiuntive:</span>
                    <span class="kv-value">{{ number_format($additionalExpenses, 2, ',', '.') }} €</span>
                </div>
                <div style="padding-left: 15px; font-size: 0.9em; color: #666;">
                    @foreach($customer->expenses as $expense)
                        <div class="kv-row">
                            <span>• {{ ucfirst(str_replace('_', ' ', $expense->expense_type)) }}</span>
                            <span>{{ number_format($expense->amount, 2, ',', '.') }} €</span>
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
                <span class="kv-value">- {{ number_format($customer->down_payment ?? 0, 2, ',', '.') }} €</span>
            </div>

            <div class="total-row">
                <!-- Modificato per Ricevuta Fiscale: Mostra Totale Pagato invece di Saldo da Pagare -->
                <!-- Assumiamo che se stampi la ricevuta, il cliente abbia saldato tutto il dovuto finale -->
                <span>Totale Pagato:</span>
                <span>{{ number_format($finalBalance ?? (($grandTotal ?? 0) - ($customer->down_payment ?? 0)), 2, ',', '.') }}
                    €</span>
            </div>

            <!-- Footer -->
            <div class="footer-note">
                <p class="mb-1">Grazie per aver scelto Hotel Gemma del Mare</p>
                <p class="mb-0">www.gemmadelmare.com</p>
            </div>

            <!-- Pulsante Stampa -->
            <div class="text-center mt-4 print-btn">
                <button onclick="window.print()" class="btn btn-primary btn-lg">
                    <i class="fas fa-print me-2"></i>Stampa Ricevuta
                </button>
            </div>
        </div>
    </div>

    <!-- Font Awesome per le icone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Genera stringa casuale alfanumerica
            function generateReceiptNumber(length) {
                const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                let result = "";
                for (let i = 0; i < length; i++) {
                    result += charset.charAt(Math.floor(Math.random() * charset.length));
                }
                return result;
            }

            // Imposta il numero nella ricevuta (lunghezza 8 per esempio)
            // Puoi cambiare la lunghezza o aggiungere prefissi se necessario (es. "2025-")
            const receiptSpan = document.getElementById('receipt-number');
            receiptSpan.textContent += generateReceiptNumber(8);

            // Avvio automatico stampa
            window.print();
        });
    </script>
</body>

</html>