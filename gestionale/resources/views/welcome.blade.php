<x-layout title="Calendario - Gemma Hotel">
    <div id="calendar-header" class="d-flex justify-content-between align-items-center mb-3"
        style="transition: opacity 0.3s, transform 0.3s;">
        <h1 class="h3">Calendario Prenotazioni</h1>
        <div>
            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary mx-2">Oggi</a>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="calendar-container" style="max-height: 80vh; overflow: auto; position: relative;">
                <div style="display: flex; min-width: max-content;">
                    <!-- Colonna Fissa: Camere -->
                    <div class="room-column"
                        style="position: sticky; left: 0; z-index: 50; background: white; border-right: 1px solid #dee2e6; width: 150px; min-width: 150px; max-width: 150px; flex-shrink: 0;">
                        <div class="date-header"
                            style="height: 50px; line-height: 50px; background: #fff; position: sticky; top: 0; z-index: 60; border-bottom: 1px solid #dee2e6;">
                            Camera</div>
                        @foreach($rooms as $roomNumber => $roomName)
                            <div class="room-cell d-flex flex-column justify-content-center align-items-center text-center"
                                style="height: 60px; border-bottom: 1px solid #dee2e6; background: white;"
                                data-room="{{ $roomNumber }}">
                                <div>
                                    <div class="fw-bold">{{ $roomNumber }}</div>
                                    <div class="small text-muted" style="font-size: 0.75rem;">
                                        {{ Str::limit($roomName, 15) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Griglia Scorrevole -->
                    <div style="flex: 1;">
                        <!-- Intestazione Date -->
                        <div
                            style="display: flex; position: sticky; top: 0; z-index: 10; background: white; border-bottom: 1px solid #dee2e6;">
                            @foreach($dates as $date)
                                <div class="date-header {{ $date->isToday() ? 'today-column' : '' }}"
                                    style="flex: 0 0 120px; height: 50px; padding: 5px;"
                                    @if($date->format('Y-m-d') == $centerDate->format('Y-m-d')) id="center-date-header"
                                    @endif>
                                    <div class="small {{ $date->isSunday() ? 'text-danger fw-bold' : 'text-muted' }}">
                                        {{ $date->locale('it')->translatedFormat('D') }}
                                    </div>
                                    <div class="fw-bold {{ $date->isSunday() ? 'text-danger' : '' }}">
                                        {{ $date->format('d/m') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Righe Camere -->
                        <div style="position: relative;">
                            @foreach($rooms as $roomNumber => $roomName)
                                <div style="display: flex; height: 60px;">
                                    @php
                                        $currentDateIndex = 0;
                                        $totalDates = count($dates);
                                    @endphp

                                    @while($currentDateIndex < $totalDates)
                                        @php
                                            $date = $dates[$currentDateIndex];
                                            $dateKey = $date->format('Y-m-d');

                                            // Direct lookup O(1)
                                            $reservation = $dailyReservations[$roomNumber][$dateKey] ?? null;

                                            $isToday = $date->isToday();
                                            $class = $isToday ? 'today-column' : '';
                                        @endphp

                                        @if($reservation && $reservation->arrival_date == $dateKey)
                                            {{-- Inizia oggi --}}
                                            @php
                                                // Calcola larghezza (colspan)
                                                $dep = Carbon\Carbon::parse($reservation->departure_date);

                                                $span = 0;
                                                $tempIndex = $currentDateIndex;
                                                // Cicla finché la prenotazione continua nei giorni successivi e siamo all'interno della vista
                                                while ($tempIndex < $totalDates) {
                                                    $nextDateKey = $dates[$tempIndex]->format('Y-m-d');
                                                    $nextRes = $dailyReservations[$roomNumber][$nextDateKey] ?? null;

                                                    // Deve essere lo STESSO ID di prenotazione per continuare lo span
                                                    if ($nextRes && $nextRes->id == $reservation->id) {
                                                        $span++;
                                                        $tempIndex++;
                                                    } else {
                                                        break;
                                                    }
                                                }
                                            @endphp

                                            <div class="grid-cell {{ $class }} {{ $reservation->group_id ? 'group-event-cell' : '' }}"
                                                style="flex: 0 0 {{ $span * 120 }}px; width: {{ $span * 120 }}px; z-index: 5;">
                                                <a href="{{ route('customers.show', $reservation) }}"
                                                    class="text-decoration-none text-white d-block h-100">
                                                    <div
                                                        class="booking-block {{ $reservation->group_id ? 'booking-source-group' : ($reservation->payment_method == 'booking' ? 'booking-source-booking' : 'booking-source-cash') }}">
                                                        @if($reservation->group_id)
                                                            <strong class="text-truncate d-block w-100"
                                                                style="font-size: 0.85rem;">{{ $reservation->first_name }}</strong>
                                                        @else
                                                            <strong>{{ $reservation->first_name }}
                                                                {{ $reservation->last_name }}</strong>
                                                            <small>
                                                                {{ $reservation->pax }} pax - {{ $reservation->treatment }}
                                                                <span class="booking-sticker">
                                                                    @if($reservation->payment_method == 'booking')
                                                                        <span style="color: #dc3545;">BK</span>
                                                                    @else
                                                                        <span style="color: #198754;">$</span>
                                                                    @endif
                                                                </span>
                                                            </small>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            @php $currentDateIndex += $span; @endphp

                                        @elseif($reservation && $currentDateIndex == 0)
                                            {{-- Iniziata prima, ma copre il primo giorno visibile --}}
                                            @php
                                                // Calcola span rimanente NELLA VISTA
                                                $span = 0;
                                                $tempIndex = $currentDateIndex;
                                                while ($tempIndex < $totalDates) {
                                                    $nextDateKey = $dates[$tempIndex]->format('Y-m-d');
                                                    $nextRes = $dailyReservations[$roomNumber][$nextDateKey] ?? null;

                                                    if ($nextRes && $nextRes->id == $reservation->id) {
                                                        $span++;
                                                        $tempIndex++;
                                                    } else {
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            <div class="grid-cell {{ $class }} {{ $reservation->group_id ? 'group-event-cell' : '' }}"
                                                style="flex: 0 0 {{ $span * 120 }}px; width: {{ $span * 120 }}px; z-index: 5;">
                                                <a href="{{ route('customers.show', $reservation) }}"
                                                    class="text-decoration-none text-white d-block h-100">
                                                    <div
                                                        class="booking-block {{ $reservation->group_id ? 'booking-source-group' : ($reservation->payment_method == 'booking' ? 'booking-source-booking' : 'booking-source-cash') }}">
                                                        @if($reservation->group_id)
                                                            <small>&laquo; Continua</small>
                                                            <strong class="text-truncate d-block w-100"
                                                                style="font-size: 0.85rem;">{{ $reservation->first_name }}</strong>
                                                        @else
                                                            <small>&laquo; Continua</small>
                                                            <strong>{{ $reservation->first_name }}
                                                                {{ $reservation->last_name }}</strong>
                                                            <span class="booking-sticker">
                                                                @if($reservation->payment_method == 'booking')
                                                                    <span style="color: #dc3545;">BK</span>
                                                                @else
                                                                    <span style="color: #198754;">$</span>
                                                                @endif
                                                            </span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            @php $currentDateIndex += $span; @endphp

                                        @elseif($reservation)
                                            <div class="grid-cell {{ $class }}" style="flex: 0 0 120px;"></div>
                                            @php $currentDateIndex++; @endphp
                                        @else
                                            {{-- Free --}}
                                            <div class="grid-cell {{ $class }}" style="flex: 0 0 120px;"></div>
                                            @php $currentDateIndex++; @endphp
                                        @endif
                                    @endwhile
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <x-slot name="scripts">
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.querySelector('.calendar-container');
                const target = document.getElementById('center-date-header');

                if (container && target) {
                    // Calcola la posizione per centrare l'elemento
                    const containerWidth = container.clientWidth;
                    const roomColumnWidth = 150; // Larghezza colonna fissa
                    const centerOffset = (containerWidth - roomColumnWidth) / 2;

                    // Scrolla
                    container.scrollLeft = target.offsetLeft - roomColumnWidth - centerOffset + (target.clientWidth / 2);
                }
            });
        </script>
    </x-slot>
</x-layout>