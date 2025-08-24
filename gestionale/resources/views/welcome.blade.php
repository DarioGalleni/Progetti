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

        <h2 class="mb-4 text-center">Calendario - {{ $selectedMonth->translatedFormat('F Y') }}</h2>

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

    {{-- Calendario --}}
        <div id="calendar-container" class="table-responsive drag-scroll calendar-max-height">
            <table class="table table-bordered align-middle text-center table-nowrap">
                <thead class="table-light sticky-top">
                    <tr>
                        <th class="sticky-header-room bg-light sticky-room-header">
                            Camera
                        </th>

                        @php $currentDate = $firstDayOfCalendar->copy(); @endphp

                        @while($currentDate->lte($lastDayOfCalendar))
                            @php
                                $isHoliday = $currentDate->dayOfWeek === Carbon::SUNDAY;
                                $isToday = $currentDate->isToday();
                                $isDifferentMonth = $currentDate->month !== $selectedMonth->month;
                            @endphp

                            <th class="{{ $isHoliday ? 'text-danger' : '' }} {{ $isToday ? 'bg-warning' : '' }} {{ $isDifferentMonth ? 'text-muted' : '' }}" @if($isToday) id="today" @endif>
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
                            102 => 'TR V.P', 103 => 'TR V. P', 104 => 'QD V.P', 105 => 'TR V.P',
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
                                $cellsToSkip = 0;
                            @endphp

                            @while($currentDate->lte($lastDayOfCalendar))
                                @if($cellsToSkip > 0)
                                    @php
                                        $cellsToSkip--;
                                        $currentDate->addDay();
                                    @endphp
                                @else
                                    @php
                                        $foundBooking = collect($roomBookings[$roomNumber] ?? [])->first(function ($booking) use ($currentDate) {
                                            $start = Carbon::parse($booking->arrival_date);
                                            $end = Carbon::parse($booking->departure_date)->subDay();
                                            return $currentDate->between($start, $end);
                                        });
                                    @endphp

                                    @if($foundBooking)
                                        @php
                                            $arrival = Carbon::parse($foundBooking->arrival_date);
                                            $departure = Carbon::parse($foundBooking->departure_date);
                                            $span = max(1, $arrival->diffInDays($departure));
                                            $cellsToSkip = $span - 1;
                                        @endphp

                                        <td colspan="{{ $span }}" class="bg-primary text-white position-relative">
                                            <a href="{{ route('customers.show', $foundBooking->id) }}" class="stretched-link text-white text-decoration-none">
                                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                                    <div>{{ $foundBooking->first_name }} {{ $foundBooking->last_name }}</div>
                                                    <small>{{ $foundBooking->number_of_people }} pers. – {{ $foundBooking->treatment }}</small>
                                                </div>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif

                                    @php $currentDate->addDay(); @endphp
                                @endif
                            @endwhile
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>