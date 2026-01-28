@php
    use Carbon\Carbon;
    Carbon::setLocale('it');

    $selectedMonth = request('month')
        ? Carbon::parse(request('month'))
        : Carbon::now();

    $firstDayOfCalendar = $selectedMonth->copy()
        ->startOfMonth()
        ->startOfWeek(Carbon::MONDAY);

    $lastDayOfCalendar = $selectedMonth->copy()
        ->addMonth()
        ->endOfMonth()
        ->endOfWeek(Carbon::SUNDAY);

    $previousMonth = $selectedMonth->copy()->subMonth();
    $nextMonth = $selectedMonth->copy()->addMonth();
@endphp

<x-layout>
    @section('title', 'Calendario Camere')

    <div class="container-fluid py-4">
        {{-- Avviso Successo --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Avviso Errore --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Intestazione & Navigazione --}}
        <div class="card shadow border-0 mb-4 rounded-3">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <h2 class="fw-bold text-primary mb-3 mb-md-0">
                        <i class="far fa-calendar-alt me-2"></i>Calendario -
                        {{ ucfirst($selectedMonth->translatedFormat('F Y')) }}
                    </h2>

                    <div class="btn-group shadow-sm" role="group">
                        <a href="{{ route('welcome', ['month' => $previousMonth->format('Y-m')]) }}"
                            class="btn btn-outline-secondary">
                            <i class="fas fa-chevron-left me-1"></i> Precedente
                        </a>
                        <a href="{{ route('welcome', ['month' => Carbon::now()->format('Y-m')]) }}"
                            class="btn btn-outline-primary active">
                            Mese Corrente
                        </a>
                        <a href="{{ route('welcome', ['month' => $nextMonth->format('Y-m')]) }}"
                            class="btn btn-outline-secondary">
                            Successivo <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabella Calendario --}}
        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-0">
                <div id="calendar-container" class="table-responsive drag-scroll calendar-max-height">
                    <table class="table table-bordered align-middle text-center table-nowrap mb-0 table-hover">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th class="sticky-header-room bg-light sticky-room-header shadow-sm border-bottom"
                                    style="min-width: 140px; z-index: 1020;">
                                    <div class="py-2">Camera</div>
                                </th>
                                @php $currentDate = $firstDayOfCalendar->copy(); @endphp
                                @while($currentDate->lte($lastDayOfCalendar))
                                    @php
                                        $isHoliday = $currentDate->dayOfWeek === Carbon::SUNDAY;
                                        $isToday = $currentDate->isToday();
                                        $isDifferentMonth = $currentDate->month !== $selectedMonth->month;
                                        $cellClass = '';
                                        if ($isHoliday)
                                            $cellClass .= 'text-danger ';
                                        if ($isToday)
                                            $cellClass .= 'bg-warning-subtle text-dark border-warning fw-bold today-cell ';
                                        if ($isDifferentMonth)
                                            $cellClass .= 'bg-light text-muted ';
                                    @endphp
                                    <th class="{{ $cellClass }}" @if($isToday) id="today" @endif
                                        style="min-width: 90px; max-width: 90px; width: 90px;">
                                        <div class="d-flex flex-column py-1">
                                            <span class="fs-5">{{ $currentDate->day }}</span>
                                            <small class="text-uppercase" style="font-size: 0.7rem;">
                                                {{ $currentDate->translatedFormat('D') }}
                                            </small>
                                        </div>
                                    </th>
                                    @php $currentDate->addDay(); @endphp
                                @endwhile
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $roomBookings = $customers->groupBy('room');
                            @endphp

                            @foreach(config('rooms') as $roomNumber => $roomLabel)
                                <tr>
                                    <td
                                        class="sticky-header-room bg-light sticky-room-cell shadow-sm border-end fw-bold text-secondary">
                                        <div class="d-flex flex-column justify-content-center align-items-center py-2">
                                            <strong class="fs-5 text-dark">{{ $roomNumber }}</strong>
                                            <span class="badge bg-secondary text-wrap"
                                                style="font-size: 0.7rem; max-width: 120px;">{{ $roomLabel }}</span>
                                        </div>
                                    </td>
                                    @php
                                        $currentDate = $firstDayOfCalendar->copy();
                                    @endphp
                                    @while($currentDate->lte($lastDayOfCalendar))
                                        @php
                                            $foundBooking = collect($roomBookings[$roomNumber] ?? [])->first(function ($booking) use ($currentDate) {
                                                return $currentDate->between(Carbon::parse($booking->arrival_date), Carbon::parse($booking->departure_date)->subDay());
                                            });
                                        @endphp
                                        @if($foundBooking)
                                            @php
                                                $arrival = Carbon::parse($foundBooking->arrival_date);
                                                $departure = Carbon::parse($foundBooking->departure_date);
                                                $displayStart = $currentDate->copy();
                                                $displayEnd = $departure->subDay();
                                                $displayDuration = $displayStart->diffInDays($displayEnd) + 1;
                                                $remainingDays = $displayDuration;
                                            @endphp
                                            <td colspan="{{ $remainingDays }}" class="p-1 position-relative"
                                                style="min-width: 90px; max-width: 90px; width: 90px;">
                                                <a href="{{ route('customers.show', $foundBooking->id) }}"
                                                    class="card h-100 border-0 shadow-sm text-decoration-none text-white booking-card"
                                                    style="transition: transform 0.2s; background-color: {{ $foundBooking->is_group ? '#6f42c1' : '#0d6efd' }};">
                                                    <div
                                                        class="card-body d-flex flex-column align-items-center justify-content-center p-1 text-center">
                                                        <div class="fw-bold lh-1 mb-1"
                                                            style="font-size: 0.9rem; white-space: normal; word-break: break-word;">
                                                            @if($foundBooking->is_group)
                                                                {{ $foundBooking->last_name }}
                                                            @else
                                                                {{ $foundBooking->first_name }}<br>{{ $foundBooking->last_name }}
                                                            @endif
                                                        </div>
                                                        @if(!$foundBooking->is_group)
                                                            <small class="opacity-75" style="font-size: 0.75rem;">
                                                                {{ $foundBooking->number_of_people }} pers. <br>
                                                                {{ $foundBooking->treatment }}
                                                                @if($foundBooking->is_booking)
                                                                    <span class="badge bg-light text-dark border p-0 px-1 fw-bold ms-1"
                                                                        title="Booking.com"
                                                                        style="font-size: 0.65rem; line-height: 1.2;">Bk</span>
                                                                @endif
                                                                @if($foundBooking->is_cash_payment)
                                                                    <i class="fas fa-dollar-sign small ms-1" title="Pagamento Contanti"
                                                                        style="font-size: 0.7rem; color: #00ff00;"></i>
                                                                @endif
                                                            </small>
                                                        @endif
                                                    </div>
                                                </a>
                                            </td>
                                            @php
                                                $currentDate->addDays($remainingDays);
                                            @endphp
                                        @else
                                            <td class="@if($currentDate->isToday()) bg-warning-subtle @endif"
                                                style="min-width: 90px; max-width: 90px; width: 90px;"></td>
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
            </div>
        </div>
    </div>


</x-layout>