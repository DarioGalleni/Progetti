<?php
use Carbon\Carbon;
Carbon::setLocale('it');
?>

<x-layout>
    <div class="main-container container-fluid mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>✅ Successo!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>❌ Errore!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h2 class="mb-4 text-center" id="calendar-title">Calendario - {{ $selectedMonth->translatedFormat('F Y') }}</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('home', ['month' => $previousMonth->format('Y-m')]) }}" class="btn btn-secondary">
                ← Mese Precedente
            </a>
            <a href="{{ route('home', ['month' => Carbon::now()->format('Y-m')]) }}" class="btn btn-info">
                Mese Corrente
            </a>
            <a href="{{ route('home', ['month' => $nextMonth->format('Y-m')]) }}" class="btn btn-secondary">
                Mese Successivo →
            </a>
        </div>

        {{-- INIZIO: STRUTTURA ACCORDION PER LE FILE --}}
        <div class="accordion" id="calendarAccordion">
            @foreach($ombrelloniPerFila as $fila => $ombrelloni)
                @php
                    // Genera un ID univoco per l'elemento accordion
                    $collapseId = 'collapseFila' . $fila;
                    $isFirst = $loop->first; // Apri il primo accordion di default
                @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFila{{ $fila }}">
                        <button class="accordion-button {{ !$isFirst ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $isFirst ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                            <i class="fas fa-umbrella-beach me-2"></i> **Fila {{ $fila }}** ({{ $ombrelloni->count() }} Ombrelloni)
                        </button>
                    </h2>
                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}" aria-labelledby="headingFila{{ $fila }}" data-bs-parent="#calendarAccordion">
                        <div class="accordion-body p-0">
                            {{-- INIZIO: Tabella del calendario per la Fila {{ $fila }} --}}
                            <div id="calendar-container-{{ $fila }}" class="table-responsive drag-scroll calendar-max-height-fila">
                                <table class="table table-bordered align-middle text-center table-nowrap">
                                    <thead class="table-light sticky-top">
                                        <tr>
                                            <th class="sticky-header-room bg-light sticky-room-header" style="min-width: 140px;">
                                                Ombrellone
                                            </th>
                                            {{-- Ripeti qui l'intestazione dei giorni --}}
                                            @php $currentDate = $firstDayOfCalendar->copy(); @endphp
                                            @while($currentDate->lte($lastDayOfCalendar))
                                                @php
                                                    $isHoliday = $currentDate->dayOfWeek === Carbon::SUNDAY;
                                                    $isToday = $currentDate->isToday();
                                                    $isDifferentMonth = $currentDate->month !== $selectedMonth->month;
                                                @endphp
                                                <th class="{{ $isHoliday ? 'text-danger' : '' }} {{ $isToday ? 'bg-warning today-cell' : '' }} {{ $isDifferentMonth ? 'text-muted' : '' }}"
                                                    @if($isToday && $isFirst) id="today" @endif {{-- Mantieni l'ID 'today' solo per l'intestazione della prima fila --}}
                                                    style="min-width: 90px; max-width: 90px; width: 90px;">
                                                    {{ $currentDate->day }}<br>
                                                    <small>
                                                        {{ ucfirst($currentDate->translatedFormat('D')) }}
                                                        {{ $currentDate->translatedFormat('M') }}
                                                    </small>
                                                </th>
                                                @php $currentDate->addDay(); @endphp
                                            @endwhile
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Ciclo sugli ombrelloni della Fila Corrente --}}
                                        @foreach($ombrelloni->sortBy('numero') as $ombrellone)
                                            <tr>
                                                <td class="sticky-header-room bg-light sticky-room-cell">
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <strong class="room-number">{{ $ombrellone->identificativo }}</strong>
                                                        <span class="room-label">Fila {{ $ombrellone->fila }}</span>
                                                    </div>
                                                </td>
                                                
                                                @php $currentDate = $firstDayOfCalendar->copy(); @endphp
                                                
                                                @while($currentDate->lte($lastDayOfCalendar))
                                                    @php
                                                        // Trova la prima prenotazione che *include* il giorno corrente
                                                        $foundBooking = $ombrellone->prenotazioni->first(function ($booking) use ($currentDate) {
                                                            $startDate = Carbon::parse($booking->data_inizio);
                                                            $endDate = Carbon::parse($booking->data_fine); // data_fine è il giorno di *fine occupazione* (giorno prima della partenza)
                                                            
                                                            // CORREZIONE APPLICATA: Si usa $endDate direttamente, senza subDay()
                                                            return $currentDate->betweenIncluded($startDate, $endDate);
                                                        });
                                                    @endphp
                                                    
                                                    @if($foundBooking)
                                                        @php
                                                            $arrival = Carbon::parse($foundBooking->data_inizio);
                                                            $departure = Carbon::parse($foundBooking->data_fine); // Questa è la data_fine corretta nel DB
                                                            
                                                            $displayStart = $currentDate->copy();
                                                            // CORREZIONE APPLICATA: Si usa $departure direttamente senza subDay()
                                                            $displayEnd = $departure->copy()->min($lastDayOfCalendar);
                                                            
                                                            // Calcola i giorni da visualizzare da questo punto
                                                            $displayDuration = $displayStart->diffInDays($displayEnd) + 1;
                                                            $remainingDays = $displayDuration;
                                                        @endphp
                                                        <td colspan="{{ $remainingDays }}"
                                                            class="bg-primary text-white position-relative"
                                                            style="min-width: 90px;">
                                                            <div class="d-flex flex-column align-items-center justify-content-center h-100 p-1">
                                                                <div class="booking-name">
                                                                    {{ $foundBooking->nome }}<br>{{ $foundBooking->cognome }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @php
                                                            // Sposta la data corrente in avanti in base alla durata della visualizzazione della prenotazione
                                                            $currentDate->addDays($remainingDays);
                                                        @endphp
                                                    @else
                                                        {{-- Cella vuota se non ci sono prenotazioni --}}
                                                        <td style="min-width: 90px; max-width: 90px; width: 90px;"
                                                            onclick="window.location.href = '{{ route('prenotazioni.create') }}?ombrellone_id={{ $ombrellone->id }}&arrivo={{ $currentDate->format('Y-m-d') }}'"
                                                            style="cursor: pointer;"
                                                            title="Prenota {{ $ombrellone->identificativo }} per il {{ $currentDate->format('d/m') }}">
                                                        </td>
                                                        @php
                                                            $currentDate->addDay();
                                                        @endphp
                                                    @endif
                                                @endwhile
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- FINE: Tabella del calendario per la Fila {{ $fila }} --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- FINE: STRUTTURA ACCORDION PER LE FILE --}}
        
        {{-- Rimuovi il vecchio div calendar-container --}}
        {{-- <div id="calendar-container" class="table-responsive drag-scroll calendar-max-height">...</div> --}}
    </div>
</x-layout>