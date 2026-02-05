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
        <p class="text-center text-muted">Premere <strong>Ctrl + click</strong> su una casella per aggiungere una prenotazione, e <strong>Ctrl + click</strong> su una casella già occupata per visualizzare i dettagli della prenotazione</p>

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
                                                                title="CTRL + Click per dettagli di {{ $foundBooking->nome }} {{ $foundBooking->cognome }}">
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


</x-layout>