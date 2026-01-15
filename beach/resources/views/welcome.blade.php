<?php
use Carbon\Carbon;
Carbon::setLocale('it');
?>

<x-layout>
    @section('title', 'Homepage')

    <div class="main-container container-fluid mt-4 p-3">

        <h2 class="mb-4 text-center text-sea" id="calendar-title">
            Calendario - {{ $selectedMonth->translatedFormat('F Y') }}
        </h2>

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

        <div class="accordion beach-card" id="calendarAccordion">
            @foreach($ombrelloniPerFila as $fila => $ombrelloni)
                @php
                    $collapseId = 'collapseFila' . $fila;
                    $isFirst = $loop->first;
                @endphp

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFila{{ $fila }}">
                        <button class="accordion-button {{ !$isFirst ? 'collapsed' : '' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                            aria-expanded="{{ $isFirst ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                            <i class="fas fa-umbrella-beach me-2"></i>
                            Fila {{ $fila }} ({{ $ombrelloni->count() }} Ombrelloni)
                        </button>
                    </h2>

                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
                        aria-labelledby="headingFila{{ $fila }}" data-bs-parent="#calendarAccordion">

                        <div class="accordion-body p-0">
                            <div id="calendar-container-{{ $fila }}"
                                class="table-responsive drag-scroll calendar-max-height-fila">
                                <table class="table table-bordered align-middle text-center table-nowrap">
                                    <thead class="table-light sticky-top">
                                        <tr>
                                            <th class="sticky-header-room bg-light sticky-room-header"
                                                style="min-width: 140px;">
                                                Ombrellone
                                            </th>

                                            @php $currentDate = $firstDayOfCalendar->copy(); @endphp

                                            @while($currentDate->lte($lastDayOfCalendar))
                                                @php
                                                    $isHoliday = $currentDate->dayOfWeek === Carbon::SUNDAY;
                                                    $isToday = $currentDate->isToday();
                                                    $isDifferentMonth = $currentDate->month !== $selectedMonth->month;
                                                @endphp

                                                <th class="{{ $isHoliday ? 'text-danger' : '' }} {{ $isToday ? 'bg-warning today-cell' : '' }} {{ $isDifferentMonth ? 'text-muted' : '' }}"
                                                    @if($isToday && $isFirst) id="today" @endif
                                                    style="min-width: 90px; max-width: 90px; width: 90px;">
                                                    {{ $currentDate->day }}<br>
                                                    <small>{{ ucfirst($currentDate->translatedFormat('D')) }}</small>
                                                </th>

                                                @php $currentDate->addDay(); @endphp
                                            @endwhile
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($ombrelloni->sortBy('numero') as $ombrellone)
                                            <tr class="calendar-slot-row">
                                                <td class="sticky-header-room bg-light sticky-room-cell">
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <strong class="room-number">
                                                            {{ strtoupper($ombrellone->fila) }} - {{ $ombrellone->numero }}
                                                        </strong>
                                                    </div>
                                                </td>

                                                @php $currentDate = $firstDayOfCalendar->copy(); @endphp

                                                @while($currentDate->lte($lastDayOfCalendar))
                                                    @php
                                                        $foundBooking = $ombrellone->prenotazioni->first(function ($booking) use ($currentDate) {
                                                            $startDate = Carbon::parse($booking->data_inizio);
                                                            $endDate = Carbon::parse($booking->data_fine);
                                                            return $currentDate->betweenIncluded($startDate, $endDate);
                                                        });
                                                    @endphp

                                                    @if($foundBooking)
                                                        @php
                                                            $arrival = Carbon::parse($foundBooking->data_inizio);
                                                            $departure = Carbon::parse($foundBooking->data_fine);
                                                            $displayStart = $currentDate->copy();
                                                            $displayEnd = $departure->copy()->min($lastDayOfCalendar);
                                                            $displayDuration = $displayStart->diffInDays($displayEnd) + 1;
                                                            $remainingDays = $displayDuration;
                                                            $bookingUrl = route('prenotazioni.show', $foundBooking->id);
                                                        @endphp

                                                        <td colspan="{{ $remainingDays }}"
                                                            class="bg-primary p-0 position-relative prevent-drag"
                                                            style="min-width: 90px;">
                                                            <a href="javascript:void(0)"
                                                                onclick="handleCtrlClick(event, '{{ $bookingUrl }}')"
                                                                class="text-decoration-none text-white d-block h-100 w-100"
                                                                title="CTRL + Click per dettagli di {{ $foundBooking->nome }}">
                                                                <div
                                                                    class="d-flex flex-column align-items-center justify-content-center h-100 p-1">
                                                                    <div class="booking-name">
                                                                        {{ $foundBooking->nome }}<br>
                                                                        {{ $foundBooking->cognome }}
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        @php $currentDate->addDays($remainingDays); @endphp
                                                    @else
                                                        @php
                                                            $createUrl = route('prenotazioni.create') . "?ombrellone_id=" . $ombrellone->id . "&arrivo=" . $currentDate->format('Y-m-d');
                                                        @endphp

                                                        <td style="min-width: 90px; max-width: 90px; width: 90px; cursor: pointer;"
                                                            onclick="handleCtrlClick(event, '{{ $createUrl }}')"
                                                            title="CTRL + Click per prenotare Fila {{ strtoupper($ombrellone->fila) }} - {{ $ombrellone->numero }}">
                                                        </td>
                                                        @php $currentDate->addDay(); @endphp
                                                    @endif
                                                @endwhile
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modale Informativo -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-modal border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center text-sea fw-bold" id="infoModalLabel">
                        <i class="fas fa-umbrella-beach me-2"></i> Benvenuto nel Gestionale
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                </div>
                <div class="modal-body px-4 pb-4">

                    <!-- Istruzioni Utente -->
                    <div class="alert alert-info bg-light-info border-info-subtle rounded-3 mb-4 shadow-sm">
                        <div class="d-flex align-items-middle mb-2">
                            <i class="fas fa-mouse-pointer fs-4 text-info me-3"></i>
                            <div>
                                <h6 class="fw-bold text-info mb-1">Interazione Rapida</h6>
                                <p class="mb-0 text-muted small">
                                    Tieni premuto <strong>CTRL</strong> (o Cmd) +
                                    <strong>Click</strong> su una cella per aprire o creare una prenotazione.
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-middle mb-2">
                            <i class="fas fa-cogs fs-4 text-muted me-3"></i>
                            <div>
                                <h6 class="fw-bold text-muted mb-1">Ambiente di Test</h6>
                                <p class="mb-0 text-muted small">
                                    Questo è un ambiente di demo. Puoi liberamente <strong>testare, modificare e
                                        cancellare</strong> i dati.
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-middle">
                            <i class="fas fa-desktop fs-4 text-primary me-3"></i>
                            <div>
                                <h6 class="fw-bold text-primary mb-1">Dispositivo Consigliato</h6>
                                <p class="mb-0 text-muted small">
                                    Per la migliore esperienza utente, si consiglia l'utilizzo da <strong>PC o
                                        Tablet</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Sezione Qualità -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 h-100 bg-white shadow-sm hover-lift">
                                <div class="text-center mb-2">
                                    <i class="fas fa-server fs-2 text-sea-dark"></i>
                                </div>
                                <h6 class="text-center text-dark fw-bold mb-3">Qualità Backend</h6>
                                <ul class="list-unstyled text-muted small mb-0">
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>Framework:</strong>
                                        Laravel 10+</li>
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>Architettura:</strong>
                                        MVC & Principi SOLID</li>
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>Database:</strong>
                                        Relazioni Model & Eager Loading</li>
                                    <li><i class="fas fa-check text-success me-2"></i><strong>Sicurezza:</strong>
                                        Protezione CSRF & Validazione Input</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 h-100 bg-white shadow-sm hover-lift">
                                <div class="text-center mb-2">
                                    <i class="fab fa-js fs-2 text-warning"></i>
                                </div>
                                <h6 class="text-center text-dark fw-bold mb-3">Qualità Frontend</h6>
                                <ul class="list-unstyled text-muted small mb-0">
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>Tecnologia:</strong>
                                        Blade + Vanilla JS + Bootstrap 5</li>
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>UX/UI:</strong>
                                        Calendario 'Drag & Scroll' Personalizzato</li>
                                    <li class="mb-2"><i
                                            class="fas fa-check text-success me-2"></i><strong>Responsive:</strong>
                                        Design Mobile-First</li>
                                    <li><i class="fas fa-check text-success me-2"></i><strong>Performance:</strong>
                                        Interazioni DOM Ottimizzate</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-primary px-5 rounded-pill shadow-sm" data-bs-dismiss="modal">
                        Inizia a Lavorare
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>