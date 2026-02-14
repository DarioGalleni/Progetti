<?php
use Carbon\Carbon;
Carbon::setLocale('it');
?>

<x-layout>
    @section('title', 'Homepage')

    {{-- DESKTOP VIEW (Visible ONLY on LG and larger screens) --}}
    <div class="d-none d-lg-block">
        <div class="main-container container-fluid mt-4 p-3">

            <h2 class="mb-4 text-center text-sea" id="calendar-title">
                Calendario - {{ $selectedMonth->translatedFormat('F Y') }}
            </h2>
            <p class="text-center text-muted">Clicca su una casella per visualizzare i dettagli o aggiungere una
                prenotazione</p>

            <div class="row mb-4 align-items-center">
                <div class="col-4 text-start">
                    <a href="{{ route('home', ['month' => $previousMonth->format('Y-m')]) }}"
                        class="btn btn-outline-secondary">
                        <i class="fas fa-chevron-left me-1"></i> <span
                            class="d-none d-sm-inline">{{ $previousMonth->translatedFormat('F') }}</span>
                    </a>
                </div>
                <div class="col-4 text-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('home', ['month' => Carbon::now()->format('Y-m')]) }}"
                            class="btn btn-outline-primary {{ $selectedMonth->isCurrentMonth() ? 'active' : '' }}">
                            Oggi
                        </a>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <a href="{{ route('home', ['month' => $nextMonth->format('Y-m')]) }}"
                        class="btn btn-outline-secondary">
                        <span class="d-none d-sm-inline">{{ $nextMonth->translatedFormat('F') }}</span> <i
                            class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="accordion beach-card" id="calendarAccordionDesktop">
                @php $today = Carbon::now(); @endphp
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
                            aria-labelledby="headingFila{{ $fila }}" data-bs-parent="#calendarAccordionDesktop">

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

                                                    <th class="{{ $isHoliday ? 'text-danger' : '' }} {{ $isToday ? 'bg-warning today-cell js-today-header' : '' }} {{ $isDifferentMonth ? 'text-muted' : '' }}"
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
                                                        <div
                                                            class="d-flex flex-column justify-content-center align-items-center">
                                                            <strong class="room-number">
                                                                {{ strtoupper($ombrellone->fila) }} - {{ $ombrellone->numero }}
                                                            </strong>
                                                        </div>
                                                    </td>

                                                    @php $currentDate = $firstDayOfCalendar->copy(); @endphp

                                                    @while($currentDate->lte($lastDayOfCalendar))
                                                        @php
                                                            $isToday = $currentDate->isToday();
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
                                                                
                                                                // Check if today falls within this booking display period
                                                                $bookingCoversToday = $today->betweenIncluded($displayStart, $displayEnd);
                                                            @endphp

                                                            <td colspan="{{ $remainingDays }}"
                                                                class="bg-primary p-0 position-relative prevent-drag {{ $bookingCoversToday ? 'today-booking' : '' }}"
                                                                style="min-width: 90px;">
                                                                <a href="{{ $bookingUrl }}"
                                                                    class="text-decoration-none text-white d-block h-100 w-100"
                                                                    title="Dettagli di {{ $foundBooking->nome }} {{ $foundBooking->cognome }}">
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

                                                            <td class="{{ $isToday ? 'today-column' : '' }}" 
                                                                style="min-width: 90px; max-width: 90px; width: 90px; cursor: pointer;"
                                                                title="Prenota Fila {{ strtoupper($ombrellone->fila) }} - {{ $ombrellone->numero }}"
                                                                onclick="window.location.href='{{ $createUrl }}'">

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
    </div>

    {{-- MOBILE VIEW (Visible on MD, SM, XS) --}}
    <div class="d-lg-none mobile-view-container">
        @php
            $today = Carbon::now();
        @endphp

        {{-- Header Mobile --}}
        <div class="mobile-calendar-header sticky-top bg-white shadow-sm z-index-100">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="mb-0 fw-bold">{{ $today->locale('it')->translatedFormat('D, d M') }}</h5>
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center">
                    <i class="fas fa-home me-1"></i> Oggi
                </a>
            </div>
        </div>

        {{-- Widget Ricerca Disponibilità --}}
        <div class="availability-search bg-white shadow-sm p-3 mx-3 mt-3 rounded-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-search me-2 text-primary"></i> Cerca Disponibilità
                </h6>
                <button class="btn btn-sm btn-link text-decoration-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#searchForm">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>

            <div class="collapse show" id="searchForm">
                <form method="GET" action="{{ route('home') }}" class="search-availability-form">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Dal</label>
                            <input type="date" name="arrivo" class="form-control form-control-sm"
                                value="{{ request('arrivo', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Al</label>
                            <input type="date" name="partenza" class="form-control form-control-sm"
                                value="{{ request('partenza', date('Y-m-d', strtotime('+1 day'))) }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-sm fw-bold gradient-btn">
                        <i class="fas fa-umbrella-beach me-1"></i> Verifica Disponibilità
                    </button>
                    @if(isset($isSearch) && $isSearch)
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 btn-sm mt-2">
                            <i class="fas fa-times me-1"></i> Resetta Ricerca
                        </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Container Risultati o Ombrelloni Occupati Oggi --}}
        <div class="mobile-calendar-container p-3">
            @if(isset($isSearch) && $isSearch)
                <h6 class="text-muted fw-bold mb-3 ms-1 uppercase tracking-wide section-title-small">
                    <i class="fas fa-check-circle me-1 text-success"></i> DISPONIBILI DAL
                    {{ \Carbon\Carbon::parse(request('arrivo'))->format('d/m') }} AL
                    {{ \Carbon\Carbon::parse(request('partenza'))->format('d/m') }}
                </h6>

                @php $foundAny = false; @endphp

                @foreach($availableUmbrellas as $fila => $ombrelloni)
                    @foreach($ombrelloni as $ombrellone)
                        @php $foundAny = true; @endphp
                        <div class="room-card card shadow-sm mb-3 rounded-card border-0">
                            <div class="card-body p-0">
                                <div class="d-flex">
                                    <!-- Left Side: Umbrella Number -->
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center text-white p-3 umbrella-left-col" style="background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%); min-width: 90px;">
                                        <i class="fas fa-umbrella-beach mb-1 umbrella-icon opacity-50"></i>
                                        <span class="small fw-bold">{{ strtoupper($ombrellone->fila) }}</span>
                                        <span class="display-6 fw-bold mb-0">{{ $ombrellone->numero }}</span>
                                    </div>

                                    <!-- Right Side: Action -->
                                    <div class="flex-grow-1 p-3 bg-white d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="fw-bold mb-0 text-success">
                                                <i class="fas fa-check me-1"></i> Libero
                                            </h6>
                                            <small class="text-muted">Disponibile</small>
                                        </div>
                                        <a href="{{ route('prenotazioni.create', ['ombrellone_id' => $ombrellone->id, 'arrivo' => request('arrivo'), 'partenza' => request('partenza')]) }}"
                                            class="btn btn-success btn-sm fw-bold shadow-sm px-3">
                                            Prenota <i class="fas fa-chevron-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach

                @if(!$foundAny)
                    <div class="text-center py-5">
                        <div class="mb-3 text-muted opacity-50">
                            <i class="fas fa-umbrella-beach fa-3x"></i>
                        </div>
                        <h6 class="text-muted fw-bold">Nessun ombrellone disponibile</h6>
                        <p class="small text-muted">Prova a cambiare le date</p>
                    </div>
                @endif

            @else
                <h6 class="text-muted fw-bold mb-3 ms-1 uppercase tracking-wide section-title-small">
                    PRENOTATI OGGI
                </h6>

                @php
                    $occupiedCount = 0;
                @endphp

                @foreach($ombrelloniPerFila as $fila => $ombrelloni)
                    @foreach($ombrelloni->sortBy('numero') as $ombrellone)
                        @php
                            $todayBooking = $ombrellone->prenotazioni->first(function ($booking) use ($today) {
                                $start = Carbon::parse($booking->data_inizio);
                                $end = Carbon::parse($booking->data_fine);
                                // Logica "betweenIncluded"
                                return $today->betweenIncluded($start, $end);
                            });
                        @endphp

                        @if($todayBooking)
                            @php $occupiedCount++; @endphp
                            <div class="room-card card shadow-sm mb-3 rounded-card border-0">
                                <div class="card-body p-0">
                                    <a href="{{ route('prenotazioni.show', $todayBooking->id) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="d-flex">
                                            <!-- Left Side: Umbrella Number -->
                                            <div
                                                class="d-flex flex-column align-items-center justify-content-center text-white p-3 umbrella-left-col" style="background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%); min-width: 90px;">
                                                <i class="fas fa-umbrella-beach mb-1 umbrella-icon opacity-50"></i>
                                                <span class="small fw-bold">{{ strtoupper($ombrellone->fila) }}</span>
                                                <span class="display-6 fw-bold mb-0">{{ $ombrellone->numero }}</span>
                                            </div>

                                            <!-- Right Side: Details -->
                                            <div class="flex-grow-1 p-3 bg-white">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold mb-0 text-dark fs-6 font-primary">
                                                            {{ $todayBooking->nome }} {{ $todayBooking->cognome }}
                                                        </h6>
                                                        <span class="badge bg-light text-muted border mt-1">
                                                            <i class="fas fa-user-check me-1"></i> Ospite
                                                        </span>
                                                    </div>
                                                    <i class="fas fa-chevron-right text-muted opacity-50"></i>
                                                </div>

                                                <div class="d-flex align-items-center text-muted small mt-2">
                                                    <div class="d-flex align-items-center me-3">
                                                        <i class="far fa-calendar-check me-1 text-success"></i>
                                                        {{ Carbon::parse($todayBooking->data_inizio)->format('d/m') }}
                                                    </div>
                                                    <i class="fas fa-arrow-right mx-1 text-muted arrow-sep"></i>
                                                    <div class="d-flex align-items-center ms-1">
                                                        <i class="far fa-calendar-times me-1 text-danger"></i>
                                                        {{ Carbon::parse($todayBooking->data_fine)->format('d/m') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach

                @if($occupiedCount === 0)
                    <div class="text-center py-5">
                        <div class="mb-3 text-muted opacity-50">
                            <i class="fas fa-umbrella-beach fa-3x"></i>
                        </div>
                        <h6 class="text-muted fw-bold">Nessun ombrellone occupato oggi</h6>
                        <p class="small text-muted">La spiaggia è libera!</p>
                    </div>
                @endif
            @endif
        </div>
    </div>

</x-layout>