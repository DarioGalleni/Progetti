@php
    use Carbon\Carbon;
    Carbon::setLocale('it');

    // Recupera il mese dalla query string, altrimenti usa il mese corrente
    $selectedMonth = request('month') ? Carbon::parse(request('month')) : Carbon::now();

    // Calcola il primo e l'ultimo giorno del mese visualizzato
    $firstDayOfCalendar = $selectedMonth->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);
    $lastDayOfCalendar = $selectedMonth->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

    // Calcola il mese precedente e successivo per i link di navigazione
    $previousMonth = $selectedMonth->copy()->subMonth();
    $nextMonth = $selectedMonth->copy()->addMonth();

    // Rimuovi l'array dei festivi statico, considera la domenica come festivo
    $festivi = [];
@endphp

<x-layout>
    @section('title', 'Calendario Camere')@section('title', 'Calendario Camere')
    <div class="container-fluid mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="mb-4 text-center">Calendario - {{ $selectedMonth->translatedFormat('F Y') }}</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('welcome', ['month' => $previousMonth->format('Y-m')]) }}" class="btn btn-secondary">← Mese Precedente</a>
            <a href="{{ route('welcome', ['month' => Carbon::now()->format('Y-m')]) }}" class="btn btn-info">Mese Corrente</a>
            <a href="{{ route('welcome', ['month' => $nextMonth->format('Y-m')]) }}" class="btn btn-secondary">Mese Successivo →</a>
        </div>

        <div class="table-responsive" id="calendar-container" style="max-height: 80vh; overflow: auto;">
            <table class="table table-bordered align-middle text-center" style="white-space: nowrap;">
                <thead class="table-light sticky-top">
                    <tr>
                        <th class="sticky-header-room bg-light" style="position: sticky; left: 0; z-index: 2;">Camera</th>
                        @php
                            $currentDate = $firstDayOfCalendar->copy();
                        @endphp
                        @while ($currentDate->lte($lastDayOfCalendar))
                            @php
                                $dayName = ucfirst($currentDate->translatedFormat('D'));
                                $dayNumber = $currentDate->day;
                                $isHoliday = ($currentDate->dayOfWeek === Carbon::SUNDAY);
                                $isToday = $currentDate->isToday();
                                $isDifferentMonth = $currentDate->month !== $selectedMonth->month;
                            @endphp
                            <th
                                class="{{ $isHoliday ? 'text-danger' : '' }} {{ $isToday ? 'bg-warning' : '' }} {{ $isDifferentMonth ? 'text-muted' : '' }}"
                                @if($isToday) id="today" @endif
                            >
                                {{ $dayNumber }}<br>
                                <small>{{ $dayName }} {{ $currentDate->translatedFormat('M') }}</small>
                            </th>
                            @php
                                $currentDate->addDay();
                            @endphp
                        @endwhile
                    </tr>
                </thead>
                <tbody>
                    @php
                        $roomBookings = $customers->groupBy('room');
                    @endphp

                    @for ($room = 1; $room <= 30; $room++)
                        <tr>
                            <td class="sticky-header-room bg-light" style="position: sticky; left: 0; z-index: 1;">
                                Camera {{ $room }}
                            </td>
                            @php
                                $currentDate = $firstDayOfCalendar->copy();
                                $cellsToSkip = 0;
                            @endphp
                            @while ($currentDate->lte($lastDayOfCalendar))
                                @if ($cellsToSkip > 0)
                                    @php
                                        $cellsToSkip--;
                                        $currentDate->addDay();
                                    @endphp
                                @else
                                    @php
                                        $foundBooking = null;
                                        if (isset($roomBookings[$room])) {
                                            foreach ($roomBookings[$room] as $booking) {
                                                $arrivalDate = Carbon::parse($booking->arrival_date);
                                                $departureDate = Carbon::parse($booking->departure_date);

                                                if ($currentDate->isBetween($arrivalDate, $departureDate->subDay())) {
                                                    $foundBooking = $booking;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp

                                    @if ($foundBooking)
                                        @php
                                            $arrivalDate = Carbon::parse($foundBooking->arrival_date);
                                            $departureDate = Carbon::parse($foundBooking->departure_date);
                                            $span = $arrivalDate->diffInDays($departureDate);
                                            $cellsToSkip = $span - 1;
                                        @endphp
                                        <td colspan="{{ $span }}" class="bg-primary text-white position-relative">
                                            <a href="{{ route('customers.show', $foundBooking->id) }}" class="stretched-link text-white text-decoration-none">
                                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                                    <div>{{ $foundBooking->first_name }} {{ $foundBooking->last_name }}</div>
                                                    <small>{{ $foundBooking->number_of_people }} pers. - {{ $foundBooking->treatment }}</small>
                                                </div>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                    @php
                                        $currentDate->addDay();
                                    @endphp
                                @endif
                            @endwhile
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</x-layout>