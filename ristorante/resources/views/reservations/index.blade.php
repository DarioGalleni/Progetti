<x-layout>
    <div class="container mt-5 pt-5">
        <!-- Header Semplificato -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 text-white fw-light">Dashboard Prenotazioni</h4>
                <p class="text-muted small mb-0">Gestione tavoli e orari</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary text-white-50">
                <i class="fas fa-home me-2"></i>Home
            </a>
        </div>

        <div class="row g-4">
            <!-- Sidebar Calendario (Stile Flat) -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm" style="background-color: #1a1b1e; border-radius: 12px;">
                    <div class="card-body p-4">
                        <div id="calendar-container">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span id="current-month-year" class="fw-medium text-white h5 mb-0"></span>
                                <div>
                                    <button class="btn btn-sm btn-link text-muted p-0 me-2" id="prev-month"><i class="fas fa-chevron-left"></i></button>
                                    <button class="btn btn-sm btn-link text-muted p-0" id="next-month"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div id="mini-calendar"></div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top border-secondary border-opacity-10">
                            <div class="d-flex gap-3 justify-content-center">
                                <div class="d-flex align-items-center">
                                    <span class="dot bg-primary me-2" style="width: 8px; height: 8px; border-radius: 50%; opacity: 0.7;"></span>
                                    <small class="text-muted" style="font-size: 0.8rem;">Prenotazioni</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="dot bg-white me-2" style="width: 8px; height: 8px; border-radius: 50%;"></span>
                                    <small class="text-muted" style="font-size: 0.8rem;">Selezionato</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenuto Principale -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100" style="background-color: #1a1b1e; border-radius: 12px;">
                    <div class="card-body p-4">
                        <h2 class="h4 text-white mb-4 fw-normal">
                            {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y') }}
                        </h2>
                        
                        <!-- KPI Cards (Minimal) -->
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background-color: #25262b;">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="text-uppercase text-muted small fw-bold ls-1 mb-0">Pranzo</h6>
                                        <i class="fas fa-sun text-warning opacity-50"></i>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <span class="h2 text-white mb-0 me-2">{{ $lunchReservations->count() }}</span>
                                        <span class="text-muted small">prenotazioni</span>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px; background-color: rgba(255,255,255,0.05);">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($lunchTablesOccupied/20)*100 }}%; opacity: 0.7;"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">{{ $lunchTablesOccupied }} / 20 tavoli occupati</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background-color: #25262b;">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="text-uppercase text-muted small fw-bold ls-1 mb-0">Cena</h6>
                                        <i class="fas fa-moon text-primary opacity-50"></i>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <span class="h2 text-white mb-0 me-2">{{ $dinnerReservations->count() }}</span>
                                        <span class="text-muted small">prenotazioni</span>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px; background-color: rgba(255,255,255,0.05);">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($dinnerTablesOccupied/20)*100 }}%; opacity: 0.7;"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">{{ $dinnerTablesOccupied }} / 20 tavoli occupati</small>
                                </div>
                            </div>
                        </div>
                        
                        @if($lunchReservations->count() > 0 || $dinnerReservations->count() > 0)
                            <div class="custom-scrollbar" style="max-height: 500px; overflow-y: auto;">
                                <!-- Lista Pranzo -->
                                @if($lunchReservations->count() > 0)
                                    <div class="mb-4">
                                        <h6 class="text-muted text-uppercase small fw-bold mb-3 ps-2 border-start border-2 border-warning">Pranzo</h6>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-borderless align-middle mb-0" style="color: #adb5bd;">
                                                <thead class="text-muted small text-uppercase" style="border-bottom: 1px solid #2c2e33;">
                                                    <tr>
                                                        <th class="fw-normal ps-3">Ora</th>
                                                        <th class="fw-normal">Cliente</th>
                                                        <th class="fw-normal">Dettagli</th>
                                                        <th class="text-end pe-3">Gestione</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lunchReservations as $reservation)
                                                        <tr style="border-bottom: 1px solid #25262b;">
                                                            <td class="ps-3 text-white fw-medium">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                                                            <td>
                                                                <div class="text-white">{{ $reservation->name }}</div>
                                                                <small class="text-muted">{{ $reservation->phone }}</small>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-dark border border-secondary text-secondary me-1">{{ $reservation->people }} pax</span>
                                                                @if($reservation->notes)
                                                                    <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" title="{{ $reservation->notes }}"></i>
                                                                @endif
                                                            </td>
                                                            <td class="text-end pe-3">
                                                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-link text-decoration-none text-muted p-0 me-2"><i class="fas fa-pencil-alt"></i></a>
                                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Cancellare?');" class="d-inline">
                                                                    @csrf @method('DELETE')
                                                                    <button class="btn btn-link text-decoration-none text-danger p-0 opacity-50 hover-opacity-100"><i class="fas fa-trash-alt"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Lista Cena -->
                                @if($dinnerReservations->count() > 0)
                                    <div>
                                        <h6 class="text-muted text-uppercase small fw-bold mb-3 ps-2 border-start border-2 border-primary">Cena</h6>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-borderless align-middle mb-0" style="color: #adb5bd;">
                                                <thead class="text-muted small text-uppercase" style="border-bottom: 1px solid #2c2e33;">
                                                    <tr>
                                                        <th class="fw-normal ps-3">Ora</th>
                                                        <th class="fw-normal">Cliente</th>
                                                        <th class="fw-normal">Dettagli</th>
                                                        <th class="text-end pe-3">Gestione</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dinnerReservations as $reservation)
                                                        <tr style="border-bottom: 1px solid #25262b;">
                                                            <td class="ps-3 text-white fw-medium">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                                                            <td>
                                                                <div class="text-white">{{ $reservation->name }}</div>
                                                                <small class="text-muted">{{ $reservation->phone }}</small>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-dark border border-secondary text-secondary me-1">{{ $reservation->people }} pax</span>
                                                                @if($reservation->notes)
                                                                    <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" title="{{ $reservation->notes }}"></i>
                                                                @endif
                                                            </td>
                                                            <td class="text-end pe-3">
                                                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-link text-decoration-none text-muted p-0 me-2"><i class="fas fa-pencil-alt"></i></a>
                                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Cancellare?');" class="d-inline">
                                                                    @csrf @method('DELETE')
                                                                    <button class="btn btn-link text-decoration-none text-danger p-0 opacity-50 hover-opacity-100"><i class="fas fa-trash-alt"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-5 d-flex flex-column align-items-center justify-content-center h-50">
                                <div class="mb-3 p-3 rounded-circle" style="background: rgba(255,255,255,0.03);">
                                    <i class="fas fa-calendar-check fa-2x text-muted opacity-50"></i>
                                </div>
                                <h6 class="text-white fw-normal">Nessuna prenotazione</h6>
                                <p class="text-muted small mb-0">Tutto tranquillo per questa data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const datesWithReservations = @json($datesWithReservations);
        const selectedDate = '{{ $selectedDate }}';
        let currentDate = new Date();
        
        function generateCalendar(year, month) {
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const firstDayOfWeek = firstDay.getDay();
            const daysInMonth = lastDay.getDate();
            
            let html = '<div class="calendar-grid">';
            
            const dayNames = ['D', 'L', 'M', 'M', 'G', 'V', 'S'];
            dayNames.forEach(day => html += `<div class="calendar-day-header">${day}</div>`);
            
            for (let i = 0; i < firstDayOfWeek; i++) html += '<div class="calendar-day empty"></div>';
            
            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const hasReservations = datesWithReservations.includes(dateStr);
                const isSelected = dateStr === selectedDate;
                const isToday = dateStr === new Date().toISOString().split('T')[0];
                
                let classes = 'calendar-day';
                if (hasReservations) classes += ' has-reservations';
                if (isSelected) classes += ' selected';
                
                html += `<div class="${classes}" data-date="${dateStr}">${day}</div>`;
            }
            
            html += '</div>';
            
            document.getElementById('mini-calendar').innerHTML = html;
            const monthName = new Intl.DateTimeFormat('it-IT', { month: 'long', year: 'numeric' }).format(firstDay);
            document.getElementById('current-month-year').textContent = monthName.charAt(0).toUpperCase() + monthName.slice(1);
        }
        
        generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        
        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('calendar-day') && e.target.dataset.date) {
                window.location.href = `{{ route('reservations.index') }}?date=${e.target.dataset.date}`;
            }
        });
    </script>
    
    <style>
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }
        .calendar-day-header {
            text-align: center;
            font-size: 0.75rem;
            color: #6c757d;
            padding: 5px 0;
            font-weight: 500;
        }
        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 6px;
            font-size: 0.85rem;
            color: #adb5bd;
            transition: all 0.2s;
        }
        .calendar-day:hover:not(.empty) {
            background-color: #2c2e33;
            color: #fff;
        }
        .calendar-day.has-reservations {
            position: relative;
            color: #fff;
        }
        .calendar-day.has-reservations::after {
            content: '';
            position: absolute;
            bottom: 4px;
            width: 4px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 50%;
            opacity: 0.8;
        }
        .calendar-day.selected {
            background-color: #fff;
            color: #1a1b1e !important;
            font-weight: 600;
        }
        .calendar-day.empty { cursor: default; }

        /* Custom Scrollbar for dashboard list */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.02);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.2);
        }
    </style>
</x-layout>