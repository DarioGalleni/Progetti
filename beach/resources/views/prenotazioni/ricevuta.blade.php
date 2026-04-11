<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricevuta {{ $codiceRicevuta }} - {{ $prenotazione->cognome }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            padding: 20px;
        }

        .receipt-card {
            background-color: #fff;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            padding: 40px;
            border-top: 5px solid #00A3C4;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .company-details h2 {
            font-size: 24px;
            font-weight: 700;
            color: #00A3C4;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .company-details p {
            margin: 0;
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .receipt-meta {
            text-align: right;
        }

        .receipt-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #333;
            margin-bottom: 5px;
        }

        .receipt-number {
            font-family: 'Courier New', Courier, monospace;
            font-size: 16px;
            color: #666;
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .client-section {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .client-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .client-name {
            font-size: 18px;
            font-weight: 700;
            color: #222;
        }

        .table-custom {
            width: 100%;
            margin-bottom: 30px;
        }

        .table-custom th {
            background-color: #00A3C4;
            color: white;
            font-weight: 600;
            padding: 12px 15px;
            text-transform: uppercase;
            font-size: 12px;
            border: none;
        }

        .table-custom td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .total-box {
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            color: #555;
        }

        .grand-total {
            border-top: 2px solid #00A3C4;
            padding-top: 15px;
            margin-top: 10px;
            font-size: 20px;
            font-weight: 800;
            color: #00A3C4;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .btn-print {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 15px 30px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            font-weight: 600;
            z-index: 100;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .receipt-card {
                box-shadow: none;
                border: none;
                padding: 0;
                border-top: none;
            }

            .btn-print {
                display: none;
            }

            .header-section {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <button onclick="window.print()" class="btn btn-primary btn-print">
        <i class="fas fa-print me-2"></i> STAMPA RICEVUTA
    </button>

    <div class="receipt-card">
        <div class="header-section">
            <div class="company-details">
                <h2>BEACH CLUB</h2>
                <p>Stabilimento Balneare</p>
                <p>Via del Mare, 123</p>
                <p>55049 Viareggio (LU)</p>
                <p>P.IVA 12345678901</p>
            </div>
            <div class="receipt-meta">
                <div class="receipt-title">RICEVUTA</div>
                <div class="receipt-number">#{{ $codiceRicevuta }}</div>
                <div style="margin-top: 5px; color: #666; font-size: 14px;">Data: {{ now()->format('d/m/Y') }}</div>
            </div>
        </div>

        <div class="client-section">
            <div class="row">
                <div class="col-6">
                    <div class="client-label">Intestato a</div>
                    <div class="client-name">{{ $prenotazione->nome }} {{ $prenotazione->cognome }}</div>
                    @if($prenotazione->email)
                    <div class="small text-muted">{{ $prenotazione->email }}</div> @endif
                    @if($prenotazione->telefono)
                    <div class="small text-muted">{{ $prenotazione->telefono }}</div> @endif
                    <div class="small text-muted mt-1">Soggiorno: Dal
                        {{ \Carbon\Carbon::parse($prenotazione->data_inizio)->format('d/m/Y') }} al
                        {{ \Carbon\Carbon::parse($prenotazione->data_fine)->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>

        <table class="table-custom">
            <thead>
                <tr>
                    <th style="border-top-left-radius: 6px;">Descrizione Servizio</th>
                    <th class="text-end" style="border-top-right-radius: 6px;">Importo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Noleggio Ombrellone - Fila {{ strtoupper($prenotazione->ombrellone->fila) }} N.
                            {{ $prenotazione->ombrellone->numero }}</strong><br>
                        <span class="text-muted small">Periodo di
                            {{ \Carbon\Carbon::parse($prenotazione->data_inizio)->diffInDays(\Carbon\Carbon::parse($prenotazione->data_fine)) + 1 }}
                            giorni</span>
                    </td>
                    <td class="text-end fw-bold">€ {{ number_format($prenotazione->costo_totale, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-box">
                <div class="total-row">
                    <span>Imponibile</span>
                    <span>€ {{ number_format($imponibile, 2, ',', '.') }}</span>
                </div>
                <div class="total-row">
                    <span>IVA (22%)</span>
                    <span>€ {{ number_format($iva, 2, ',', '.') }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>TOTALE</span>
                    <span>€ {{ number_format($prenotazione->costo_totale, 2, ',', '.') }}</span>
                </div>
                @if($prenotazione->acconto > 0)
                    <div class="total-row text-muted mt-2 pt-2 border-top">
                        <span>Acconto Versato</span>
                        <span>- € {{ number_format($prenotazione->acconto, 2, ',', '.') }}</span>
                    </div>
                    <div class="total-row fw-bold text-dark">
                        <span>Saldo</span>
                        <span>€
                            {{ number_format($prenotazione->costo_totale - $prenotazione->acconto, 2, ',', '.') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="footer">
            <p>Grazie per averci scelto!</p>
        </div>
    </div>
</body>

</html>