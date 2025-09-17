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
    ->endOfMonth()
    ->endOfWeek(Carbon::SUNDAY);

$previousMonth = $selectedMonth->copy()->subMonth();
$nextMonth = $selectedMonth->copy()->addMonth();
@endphp

<x-layout>
    @section('title', 'Calendario Camere')

    <div class="container-fluid mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="mb-4 text-center" id="c">Calendario - {{ $selectedMonth->translatedFormat('F Y') }}</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('welcome', ['month' => $previousMonth->format('Y-m')]) }}" class="btn btn-secondary">
                ← Mese Precedente
            </a>
            <a href="{{ route('welcome', ['month' => Carbon::now()->format('Y-m')]) }}" class="btn btn-info">
                Mese Corrente
            </a>
            <a href="{{ route('welcome', ['month' => $nextMonth->format('Y-m')]) }}" class="btn btn-secondary">
                Mese Successivo →
            </a>
        </div>

        <div id="calendar-container" class="table-responsive drag-scroll calendar-max-height">
            <table class="table table-bordered align-middle text-center table-nowrap">
                <thead class="table-light sticky-top">
                    <tr>
                        <th class="sticky-header-room bg-light sticky-room-header" style="min-width: 140px;">
                            Camera
                        </th>
                        @php $currentDate = $firstDayOfCalendar->copy(); @endphp
                        @while($currentDate->lte($lastDayOfCalendar))
                            @php
                                $isHoliday = $currentDate->dayOfWeek === Carbon::SUNDAY;
                                $isToday = $currentDate->isToday();
                                $isDifferentMonth = $currentDate->month !== $selectedMonth->month;
                            @endphp
                            <th class="{{ $isHoliday ? 'text-danger' : '' }} {{ $isToday ? 'bg-warning today-cell' : '' }} {{ $isDifferentMonth ? 'text-muted' : '' }}"
                                @if($isToday) id="today" @endif
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
                    @php
                        $roomBookings = $customers->groupBy('room');
                        $roomLabels = [
                            101 => 'TR V.P', 102 => 'TR V.P', 103 => 'TR V. P', 104 => 'QD V.P', 105 => 'TR V.P',
                            106 => 'DP V.G.', 107 => 'DP NO BALC V.G.', 108 => 'DP NO BALC V.G.',
                            109 => 'DP NO BALC V.G.', 110 => 'DP V.S.', 111 => 'DP V.S.', 112 => 'SING',
                            201 => 'DP V.P', 202 => 'TR V.P.', 203 => 'TR V.P.', 204 => 'TR V.P.',
                            205 => 'SING FRANCESE', 206 => 'TR V.G.', 207 => 'DP NO BALC V.G.',
                            208 => 'DP NO BALC V.G', 209 => 'TRIPLA V.G', 210 => 'TR V.G.',
                            211 => 'TR V.S.', 301 => 'SING FRANC V.P.', 302 => 'SING', 303 => 'DP SOL.',
                            304 => 'TR NO BALC V.G', 305 => 'QD CAST NO BALC V.G', 306 => 'QD CAST + H V.S',
                            400 => 'DP ESTERNA',
                        ];
                    @endphp

                    @foreach($roomLabels as $roomNumber => $roomLabel)
                        <tr>
                            <td class="sticky-header-room bg-light sticky-room-cell">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <strong class="room-number">{{ $roomNumber }}</strong>
                                    <span class="room-label">{{ $roomLabel }}</span>
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
                                    <td colspan="{{ $remainingDays }}"
                                        class="bg-primary text-white position-relative"
                                        style="min-width: 90px; max-width: 90px; width: 90px;">
                                        <a href="{{ route('customers.show', $foundBooking->id) }}" class="stretched-link text-white text-decoration-none">
                                            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                                <div class="booking-name" style="white-space: normal; word-break: break-word;">
                                                    {{ $foundBooking->first_name }}<br>{{ $foundBooking->last_name }}
                                                </div>
                                                <small>{{ $foundBooking->number_of_people }} pers. – {{ $foundBooking->treatment }}</small>
                                            </div>
                                        </a>
                                    </td>
                                    @php
                                        $currentDate->addDays($remainingDays);
                                    @endphp
                                @else
                                    <td style="min-width: 90px; max-width: 90px; width: 90px;"></td>
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
</x-layout>