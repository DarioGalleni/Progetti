<x-layout>
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Calendario Prenotazioni</h5>
                        
                        <div id="calendar-container">
                            <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                                <button class="btn btn-sm btn-outline-primary" id="prev-month">&lt;</button>
                                <span id="current-month-year" class="fw-bold"></span>
                                <button class="btn btn-sm btn-outline-primary" id="next-month">&gt;</button>
                            </div>
                            <div id="mini-calendar"></div>
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">Legenda:</small><br>
                            <small><span class="badge bg-success me-1">●</span> Giorni con prenotazioni</small><br>
                            <small><span class="badge bg-primary me-1">●</span> Giorno selezionato</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Prenotazioni del {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}</h4>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">Torna al Sito</a>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">PRANZO (12:00 - 13:45)</h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>{{ $lunchReservations->count() }}</strong><br>
                                                <small class="text-muted">Prenotazioni</small>
                                            </div>
                                            <div class="col-6">
                                                <strong>{{ $lunchTablesOccupied }}/20</strong><br>
                                                <small class="text-muted">Tavoli occupati</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">CENA (19:30 - 22:00)</h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>{{ $dinnerReservations->count() }}</strong><br>
                                                <small class="text-muted">Prenotazioni</small>
                                            </div>
                                            <div class="col-6">
                                                <strong>{{ $dinnerTablesOccupied }}/20</strong><br>
                                                <small class="text-muted">Tavoli occupati</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($lunchReservations->count() > 0 || $dinnerReservations->count() > 0)
                            @if($lunchReservations->count() > 0)
                                <div class="mb-5">
                                    <h5 class="mb-3 text-primary">
                                        <i class="fas fa-sun me-2"></i>Pranzo
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Ora</th>
                                                    <th>Cliente</th>
                                                    <th>Persone</th>
                                                    <th>Tavoli</th>
                                                    <th>Contatto</th>
                                                    <th>Note</th>
                                                    <th>Azioni</th> </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($lunchReservations as $reservation)
                                                    <tr>
                                                        <td><strong>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</strong></td>
                                                        <td>{{ $reservation->name }}</td>
                                                        <td>
                                                            <span class="badge bg-secondary">{{ $reservation->people }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $reservation->tables_needed }}</span>
                                                        </td>
                                                        <td>
                                                            <small>
                                                                <i class="fas fa-phone"></i> {{ $reservation->phone }}<br>
                                                                <i class="fas fa-envelope"></i> {{ $reservation->email }}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <small>{{ $reservation->notes ?: '-' }}</small>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-primary me-2" title="Modifica">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler cancellare questa prenotazione?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" title="Cancella">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                            
                            @if($dinnerReservations->count() > 0)
                                <div>
                                    <h5 class="mb-3 text-warning">
                                        <i class="fas fa-moon me-2"></i>Cena
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Ora</th>
                                                    <th>Cliente</th>
                                                    <th>Persone</th>
                                                    <th>Tavoli</th>
                                                    <th>Contatto</th>
                                                    <th>Note</th>
                                                    <th>Azioni</th> </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dinnerReservations as $reservation)
                                                    <tr>
                                                        <td><strong>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</strong></td>
                                                        <td>{{ $reservation->name }}</td>
                                                        <td>
                                                            <span class="badge bg-secondary">{{ $reservation->people }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $reservation->tables_needed }}</span>
                                                        </td>
                                                        <td>
                                                            <small>
                                                                <i class="fas fa-phone"></i> {{ $reservation->phone }}<br>
                                                                <i class="fas fa-envelope"></i> {{ $reservation->email }}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <small>{{ $reservation->notes ?: '-' }}</small>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-primary me-2" title="Modifica">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler cancellare questa prenotazione?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" title="Cancella">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Nessuna prenotazione per questo giorno</h5>
                                <p class="text-muted">Seleziona una data diversa dal calendario</p>
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
            
            // Intestazione giorni della settimana
            const dayNames = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];
            dayNames.forEach(day => {
                html += `<div class="calendar-day-header">${day}</div>`;
            });
            
            // Giorni vuoti all'inizio
            for (let i = 0; i < firstDayOfWeek; i++) {
                html += '<div class="calendar-day empty"></div>';
            }
            
            // Giorni del mese
            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const hasReservations = datesWithReservations.includes(dateStr);
                const isSelected = dateStr === selectedDate;
                const isToday = dateStr === new Date().toISOString().split('T')[0];
                const isPast = new Date(dateStr) < new Date().setHours(0,0,0,0);
                
                let classes = 'calendar-day';
                if (hasReservations) classes += ' has-reservations';
                if (isSelected) classes += ' selected';
                if (isToday) classes += ' today';
                if (isPast) classes += ' past';
                
                html += `<div class="${classes}" data-date="${dateStr}">${day}</div>`;
            }
            
            html += '</div>';
            
            document.getElementById('mini-calendar').innerHTML = html;
            document.getElementById('current-month-year').textContent = 
                new Intl.DateTimeFormat('it-IT', { month: 'long', year: 'numeric' }).format(firstDay);
        }
        
        // Inizializza calendario
        generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        
        // Event listeners
        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        });
        
        // Click sui giorni
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
            gap: 2px;
        }
        
        .calendar-day-header {
            padding: 8px 4px;
            text-align: center;
            font-size: 0.8rem;
            font-weight: bold;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        
        .calendar-day {
            padding: 8px 4px;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.2s;
            min-height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
        
        .calendar-day:hover:not(.empty):not(.past) {
            background-color: #e9ecef;
        }
        
        .calendar-day.has-reservations {
            background-color: #d4edda;
            color: #155724;
            font-weight: bold;
        }
        
        .calendar-day.selected {
            background-color: #007bff !important;
            color: white !important;
        }
        
        .calendar-day.today {
            border: 2px solid #007bff;
        }
        
        .calendar-day.past {
            color: #6c757d;
            cursor: not-allowed;
        }
        
        .calendar-day.empty {
            cursor: default;
        }
    </style>
</x-layout>