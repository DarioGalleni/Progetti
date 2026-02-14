<x-layout :title="'Pulizie - ' . $date->format('d/m')" bodyId="cleaning-page">
    <h1 class="fw-bold text-primary mb-4 text-center">Pulizie Camere</h1>

    <div class="row mb-4 no-print align-items-center">
        <div class="col-md-6">
            <form action="{{ route('cleaning.index') }}" method="GET" class="d-flex align-items-center gap-2">
                <label for="date" class="fw-bold text-nowrap">Data:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $date->format('Y-m-d') }}"
                    onchange="this.form.submit()">
            </form>
        </div>
        <div class="col-md-6 text-end d-none d-md-inline">
            <a href="{{ route('cleaning.print', ['date' => $date->format('Y-m-d')]) }}" target="_blank"
                class="btn btn-primary d-none d-md-inline">
                <i class="bi bi-printer me-2"></i>Stampa
            </a>
            <button onclick="window.print()" class="btn btn-primary d-md-none">
                <i class="bi bi-printer"></i>
            </button>
        </div>
    </div>

    <table class="restaurant-table">
        <thead>
            <tr>
                <th class="col-room">Camera</th>
                <th class="col-bed">Letto</th>
                <th class="col-arrival">Arrivo</th>
                <th class="col-departure">Partenza</th>
                <th class="col-stayover">Fermo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room => $name)
                @php
                    $status = $roomStatus[$room] ?? null;
                    if (empty($status['arrival']) && empty($status['departure']) && empty($status['stayover'])) {
                        continue;
                    }
                    
                    $bedType = 'M';
                    $customer = $status['arrival'] ?? $status['stayover'];
                    if ($customer && $customer->bed_type === 'split') {
                        $bedType = 'XX';
                    }
                @endphp
                <tr>
                    <td><strong>{{ $room }}</strong></td>
                    
                    <td class="text-center"><strong>{{ $bedType }}</strong></td>

                    <td>
                        @if(!empty($status['arrival']))
                            <span class="check">X</span>
                            <span style="font-size: 0.85em; margin-left: 5px;">({{ $status['arrival']->pax }} pax)</span>
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
            @if(collect($roomStatus)->filter(fn($s) => !empty($s['arrival']) || !empty($s['departure']) || !empty($s['stayover']))->isEmpty())
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Nessuna camera da pulire per questa data
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</x-layout>