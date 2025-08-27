<x-layout>
    <!-- Hero Section -->
    <section class="hero-section vh-25 d-flex align-items-center justify-content-center text-white text-center" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('media/img/home-section.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="hero-title">Prenotazioni</h1>
            <p class="hero-subtitle">Elenco completo delle prenotazioni</p>
        </div>
    </section>

    <!-- Reservations Table -->
    <section class="py-5">
        <div class="container">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h2 class="h4">Tutte le prenotazioni</h2>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Torna alla Home</a>
            </div>

            @if($reservations->isEmpty())
                <div class="alert alert-info">Nessuna prenotazione trovata.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefono</th>
                                <th>Data</th>
                                <th>Ora</th>
                                <th>Persone</th>
                                <th>Tavoli</th>
                                <th>Tavoli rimanenti</th>
                                <th>Posti rimanenti</th>
                                <th>Note</th>
                                <th>Creata il</th>
                                <th class="text-end">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach($reservations as $r)
    @php
        // Cerca disponibilità nel record TableAvailability
        $availability = \App\Models\TableAvailability::where('date', $r->date)
            ->where('time_slot', $r->time)
            ->first();

        // Se non esiste un record di disponibilità, calcola la disponibilità totale (20 tavoli)
        $remainingTables = $availability ? (int) $availability->available_tables : 20;

        $remainingSeats = $remainingTables * 4;
    @endphp
    <tr>
        <td>{{ $r->customer->name ?? '-' }}</td>
        <td>{{ $r->customer->phone ?? '-' }}</td>
        <td>{{ \Carbon\Carbon::parse($r->date)->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($r->time)->format('H:i') }}</td>
        <td>{{ $r->people }}</td>
        <td>{{ $r->tables_required }}</td>
        <td>{{ $remainingTables }}</td>
        <td>{{ $remainingSeats }}</td>
        <td style="max-width:200px; white-space:pre-wrap;">{{ $r->notes ?? '-' }}</td>
        <td>{{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y H:i') }}</td>
        <td class="align-middle">
            <div class="d-flex justify-content-center align-items-center gap-2">
                <a href="{{ route('reservations.edit', $r->id) }}" class="btn btn-sm btn-outline-primary">Modifica</a>
                <form action="{{ route('reservations.destroy', $r->id) }}" method="POST" class="m-0" onsubmit="return confirm('Confermi la cancellazione della prenotazione {{ $r->reservation_code }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Elimina</button>
                </form>
            </div>
        </td>
    </tr>
@endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $reservations->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layout>
```