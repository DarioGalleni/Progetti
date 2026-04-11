<x-layout title="Calendario - Gemma Hotel">
    <div class="d-none d-md-block">
    <div id="calendar-header" class="d-flex justify-content-between align-items-center"
        style="transition: opacity 0.3s, transform 0.3s;">
        <div class="d-flex align-items-center gap-2">
<h1 class="h3 mb-0">Calendario Prenotazioni</h1>
        </div>
        <div>
            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary mx-2">Oggi</a>
        </div>
    </div>

    <div class="card card-custom vh-100">
        <div class="card-body p-0 vh-100">
            <div class="calendar-container" style="height: 100%; overflow: auto; position: relative;">
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
                                                                    @elseif($reservation->payment_method == 'cash')
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
                                                                @elseif($reservation->payment_method == 'cash')
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

    <div class="d-block d-md-none">
        {{-- Header Mobile --}}
        <div class="mobile-calendar-header sticky-top bg-white shadow-sm" style="z-index: 100;">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="mb-0 fw-bold">{{ $centerDate->locale('it')->translatedFormat('D, d M') }}</h5>
            </div>
        </div>

        {{-- Widget Ricerca Disponibilità --}}
        <div class="availability-search bg-white shadow-sm p-3 mx-3 mt-3" style="border-radius: 12px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold">
                    <i class="fa-solid fa-search"></i> Cerca Disponibilità
                </h6>
                <button class="btn btn-sm btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#searchForm">
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>

            <div class="collapse show" id="searchForm">
                <form method="GET" action="{{ route('welcome') }}" class="search-availability-form">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Check-in</label>
                            <input type="date" name="check_in" class="form-control" value="{{ request('check_in') }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Check-out</label>
                            <input type="date" name="check_out" class="form-control" value="{{ request('check_out') }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-search"></i> Verifica Disponibilità
                    </button>
                </form>

                @if(request('check_in') && request('check_out'))
                    @php
                        $checkIn = \Carbon\Carbon::parse(request('check_in'));
                        $checkOut = \Carbon\Carbon::parse(request('check_out'));
                        $availableRooms = [];
                        $occupiedRooms = [];

                        foreach ($rooms as $roomNumber => $roomName) {
                            $isAvailable = true;
                            $currentDate = $checkIn->copy();

                            while ($currentDate->lt($checkOut)) {
                                $dateKey = $currentDate->format('Y-m-d');
                                if (isset($dailyReservations[$roomNumber][$dateKey])) {
                                    $isAvailable = false;
                                    $occupiedRooms[$roomNumber] = $roomName;
                                    break;
                                }
                                $currentDate->addDay();
                            }

                            if ($isAvailable) {
                                $availableRooms[$roomNumber] = $roomName;
                            }
                        }

                        $nights = $checkIn->diffInDays($checkOut);
                    @endphp

                    <div class="mt-3 p-3" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 8px;">
                        <div class="text-center mb-2">
                            <small class="text-muted">
                                <i class="fa-solid fa-calendar-days"></i>
                                {{ $checkIn->format('d/m/Y') }} - {{ $checkOut->format('d/m/Y') }}
                                <span class="badge bg-info ms-1">{{ $nights }} {{ $nights == 1 ? 'notte' : 'notti' }}</span>
                            </small>
                        </div>

                        @if(count($availableRooms) > 0)
                            <div class="alert alert-success mb-2" style="border-radius: 8px;">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle-check me-2" style="font-size: 1.5rem;"></i>
                                    <div>
                                        <strong>{{ count($availableRooms) }} {{ count($availableRooms) == 1 ? 'camera disponibile' : 'camere disponibili' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="available-rooms-list">
                                @foreach($availableRooms as $number => $name)
                                    <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-white" style="border-radius: 8px; border-left: 4px solid #198754;">
                                        <div>
                                            <strong class="text-success">Camera {{ $number }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $name }}</small>
                                        </div>
                                        <a href="{{ url('/customers/create') }}?room={{ $number }}&arrival={{ request('check_in') }}&departure={{ request('check_out') }}" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-circle-plus"></i> Prenota
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-danger" style="border-radius: 8px;">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle-xmark me-2" style="font-size: 1.5rem;"></i>
                                    <div>
                                        <strong>Nessuna camera disponibile</strong>
                                        <br>
                                        <small>Tutte le camere sono occupate nel periodo selezionato</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(count($occupiedRooms) > 0)
                            <details class="mt-2">
                                <summary class="text-muted small" style="cursor: pointer;">
                                    {{ count($occupiedRooms) }} {{ count($occupiedRooms) == 1 ? 'camera occupata' : 'camere occupate' }}
                                </summary>
                                <div class="mt-2">
                                    @foreach($occupiedRooms as $number => $name)
                                        <div class="d-flex align-items-center p-2 mb-1 bg-light" style="border-radius: 8px; border-left: 4px solid #dc3545;">
                                            <div>
                                                <small class="text-danger fw-bold">Camera {{ $number }}</small>
                                                <br>
                                                <small class="text-muted">{{ $name }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </details>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- Container Camere Occupate --}}
        <div class="mobile-calendar-container p-3">
            @foreach($rooms as $roomNumber => $roomName)
                @php
                    // Verifica se la camera è occupata OGGI (nella data visualizzata)
                    $dateKey = $centerDate->format('Y-m-d');
                    $todayReservation = $dailyReservations[$roomNumber][$dateKey] ?? null;
                @endphp

                @if($todayReservation)
                    {{-- Card Camera Occupata --}}
                    <div class="room-card card shadow-sm mb-2" style="border-radius: 12px; overflow: hidden;">
                        {{-- Header Camera --}}
                        <div class="card-header bg-gradient text-white p-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold">Camera {{ $roomNumber }}</h6>
                                    <small class="opacity-75">{{ $roomName }}</small>
                                </div>
                                <div class="badge bg-white text-dark">
                                    <i class="fa-solid fa-door-closed"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Corpo Card --}}
                        <div class="card-body p-2">
                            <a href="{{ route('customers.show', $todayReservation) }}" class="text-decoration-none">
                                <div class="booking-item p-2" style="transition: background-color 0.2s;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-1">
                                            {{-- Nome Ospite --}}
                                            <div class="d-flex align-items-center mb-1 flex-wrap">
                                                <span class="badge bg-dark me-2" style="font-size: 0.7rem;">
                                                    <i class="fa-solid fa-door-closed"></i> {{ $roomNumber }}
                                                </span>
                                                @if($todayReservation->group_id)
                                                    <span class="badge me-2" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; font-size: 0.7rem;">
                                                        <i class="fa-solid fa-users"></i> GRUPPO
                                                    </span>
                                                @endif
                                                <h6 class="mb-0 fw-bold text-dark">
                                                    {{ $todayReservation->first_name }}
                                                    @if(!$todayReservation->group_id)
                                                        {{ $todayReservation->last_name }}
                                                    @endif
                                                </h6>
                                            </div>

                                            {{-- Dettagli --}}
                                            @if(!$todayReservation->group_id)
                                                <div class="d-flex flex-wrap gap-1 mb-1">
                                                    <span class="badge bg-light text-dark" style="font-size: 0.7rem;">
                                                        <i class="fa-solid fa-user"></i> {{ $todayReservation->pax }} pax
                                                    </span>
                                                    <span class="badge bg-light text-dark" style="font-size: 0.7rem;">
                                                        <i class="fa-solid fa-utensils"></i> {{ $todayReservation->treatment }}
                                                    </span>
                                                </div>
                                            @endif

                                            {{-- Date --}}
                                            <div class="small text-muted">
                                                <i class="fa-solid fa-calendar-check"></i>
                                                {{ \Carbon\Carbon::parse($todayReservation->arrival_date)->format('d/m/Y') }}
                                                <i class="fa-solid fa-arrow-right mx-1"></i>
                                                <i class="fa-solid fa-calendar-xmark"></i>
                                                {{ \Carbon\Carbon::parse($todayReservation->departure_date)->format('d/m/Y') }}
                                                @php
                                                    $nights = \Carbon\Carbon::parse($todayReservation->arrival_date)->diffInDays(\Carbon\Carbon::parse($todayReservation->departure_date));
                                                @endphp
                                                <span class="ms-1 badge bg-info" style="font-size: 0.65rem;">{{ $nights }} {{ $nights == 1 ? 'notte' : 'notti' }}</span>
                                            </div>
                                        </div>

                                        {{-- Badge Pagamento --}}
                                        <div class="ms-2">
                                            @if($todayReservation->payment_method == 'booking')
                                                <div class="payment-badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 6px 10px; border-radius: 8px; font-weight: bold; font-size: 0.7rem;">
                                                    <i class="fa-solid fa-globe"></i> BK
                                                </div>
                                            @elseif($todayReservation->payment_method == 'cash')
                                                <div class="payment-badge" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; padding: 6px 10px; border-radius: 8px; font-weight: bold; font-size: 0.7rem;">
                                                    <i class="fa-solid fa-money-bill-wave"></i> €
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <style>
            /* Visualizzazione Mobile */
            /* body handled globally */

            .mobile-calendar-header {
                border-bottom: 1px solid #e0e0e0;
            }

            .mobile-calendar-container {
                padding-bottom: 80px;
            }

            .room-card {
                border: none;
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .room-card:active {
                transform: scale(0.98);
            }

            .booking-item {
                background-color: white;
                transition: background-color 0.2s;
                border-radius: 8px;
            }

            .booking-item:hover,
            .booking-item:active {
                background-color: #f8f9fa;
            }

            .bg-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            /* Animazioni */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .room-card {
                animation: fadeInUp 0.4s ease-out backwards;
            }

            .room-card:nth-child(1) { animation-delay: 0.05s; }
            .room-card:nth-child(2) { animation-delay: 0.1s; }
            .room-card:nth-child(3) { animation-delay: 0.15s; }
            .room-card:nth-child(4) { animation-delay: 0.2s; }
            .room-card:nth-child(5) { animation-delay: 0.25s; }
            .room-card:nth-child(6) { animation-delay: 0.3s; }
        </style>

        <script>
            // Effetto touch sui card
            document.addEventListener('DOMContentLoaded', function() {
                const bookingItems = document.querySelectorAll('.booking-item');

                bookingItems.forEach(item => {
                    item.addEventListener('touchstart', function() {
                        this.style.backgroundColor = '#e9ecef';
                    });

                    item.addEventListener('touchend', function() {
                        setTimeout(() => {
                            this.style.backgroundColor = '';
                        }, 150);
                    });
                });
            });
        </script>
    </div>
</x-layout>