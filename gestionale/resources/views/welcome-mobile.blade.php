<x-layout title="Calendario Mobile - Gemma Hotel">
    {{-- Header Mobile --}}
    <div class="mobile-calendar-header sticky-top bg-white shadow-sm" style="z-index: 100;">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 fw-bold">{{ $centerDate->locale('it')->translatedFormat('D, d M') }}</h5>
            <a href="{{ route('welcome') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center mt-1">
                <i class="bi bi-display me-1"></i> Vista Desktop
            </a>
        </div>
    </div>

    {{-- Widget Ricerca Disponibilità --}}
    <div class="availability-search bg-white shadow-sm p-3 mx-3 mt-3" style="border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 fw-bold">
                <i class="bi bi-search"></i> Cerca Disponibilità
            </h6>
            <button class="btn btn-sm btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#searchForm">
                <i class="bi bi-chevron-down"></i>
            </button>
        </div>

        <div class="collapse show" id="searchForm">
            <form method="GET" action="{{ route('mobile-calendar') }}" class="search-availability-form">
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
                    <i class="bi bi-search"></i> Verifica Disponibilità
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
                            <i class="bi bi-calendar-range"></i>
                            {{ $checkIn->format('d/m/Y') }} - {{ $checkOut->format('d/m/Y') }}
                            <span class="badge bg-info ms-1">{{ $nights }} {{ $nights == 1 ? 'notte' : 'notti' }}</span>
                        </small>
                    </div>

                    @if(count($availableRooms) > 0)
                        <div class="alert alert-success mb-2" style="border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2" style="font-size: 1.5rem;"></i>
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
                                        <i class="bi bi-plus-circle"></i> Prenota
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-danger" style="border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-x-circle-fill me-2" style="font-size: 1.5rem;"></i>
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
                                <i class="bi bi-door-closed"></i>
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
                                                <i class="bi bi-door-closed-fill"></i> {{ $roomNumber }}
                                            </span>
                                            @if($todayReservation->group_id)
                                                <span class="badge me-2" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; font-size: 0.7rem;">
                                                    <i class="bi bi-people-fill"></i> GRUPPO
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
                                                    <i class="bi bi-person-fill"></i> {{ $todayReservation->pax }} pax
                                                </span>
                                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">
                                                    <i class="bi bi-egg-fried"></i> {{ $todayReservation->treatment }}
                                                </span>
                                            </div>
                                        @endif

                                        {{-- Date --}}
                                        <div class="small text-muted">
                                            <i class="bi bi-calendar-check"></i>
                                            {{ \Carbon\Carbon::parse($todayReservation->arrival_date)->format('d/m/Y') }}
                                            <i class="bi bi-arrow-right mx-1"></i>
                                            <i class="bi bi-calendar-x"></i>
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
                                                <i class="bi bi-globe"></i> BK
                                            </div>
                                        @elseif($todayReservation->payment_method == 'cash')
                                            <div class="payment-badge" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; padding: 6px 10px; border-radius: 8px; font-weight: bold; font-size: 0.7rem;">
                                                <i class="bi bi-cash"></i> €
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
        body {
            background-color: #f8f9fa;
        }

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

        .floating-action-button:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4) !important;
        }

        .floating-action-button:active {
            transform: scale(0.95);
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

        /* Badge Gradienti */
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Touch Targets */
        @media (max-width: 576px) {
            .btn {
                min-height: 44px;
                min-width: 44px;
            }
        }
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
</x-layout>