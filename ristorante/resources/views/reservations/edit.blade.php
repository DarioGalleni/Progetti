<x-layout>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Modifica Prenotazione</h3>
                        
                        <form action="{{ route('reservations.update.token', $reservation->modification_token) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="name" class="form-label">Nome e Cognome</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $reservation->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Telefono</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $reservation->phone) }}" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $reservation->email) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="people" class="form-label">Numero di persone</label>
                                    <select class="form-select" id="people" name="people" required>
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}" {{ old('people', $reservation->people) == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ $i == 1 ? 'persona' : 'persone' }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="date" class="form-label">Data</label>
                                    <input type="date" class="form-control" id="date" name="date" 
                                            value="{{ old('date', $reservation->date->format('Y-m-d')) }}" required min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="time" class="form-label">Ora</label>
                                    <select class="form-select" id="time" name="time" required>
                                        <option value="" disabled>Seleziona un orario</option>
                                        <optgroup label="Pranzo (12:00 - 13:45)">
                                            @for ($h = 12; $h <= 13; $h++)
                                                @for ($m = 0; $m < 60; $m += 15)
                                                    @php
                                                        $timeValue = sprintf('%02d:%02d', $h, $m);
                                                        $timeLimit = ($h == 13 && $m > 45);
                                                        $currentTime = old('time', $reservation->time->format('H:i'));
                                                    @endphp
                                                    @if (!$timeLimit)
                                                        <option value="{{ $timeValue }}" {{ $currentTime == $timeValue ? 'selected' : '' }}>{{ $timeValue }}</option>
                                                    @endif
                                                @endfor
                                            @endfor
                                        </optgroup>
                                        <optgroup label="Cena (19:30 - 22:00)">
                                            @for ($h = 19; $h <= 22; $h++)
                                                @for ($m = 0; $m < 60; $m += 15)
                                                    @php
                                                        $timeValue = sprintf('%02d:%02d', $h, $m);
                                                        $tooEarly = ($h == 19 && $m < 30);
                                                        $tooLate = ($h == 22 && $m > 0);
                                                        $currentTime = old('time', $reservation->time->format('H:i'));
                                                    @endphp
                                                    @if (!$tooEarly && !$tooLate)
                                                        <option value="{{ $timeValue }}" {{ $currentTime == $timeValue ? 'selected' : '' }}>{{ $timeValue }}</option>
                                                    @endif
                                                @endfor
                                            @endfor
                                            <option value="22:00" {{ old('time', $reservation->time->format('H:i')) == '22:00' ? 'selected' : '' }}>22:00</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="notes" class="form-label">Note aggiuntive</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $reservation->notes) }}</textarea>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Aggiorna Prenotazione</button>
                                <button type="button" class="btn btn-danger" onclick="cancelReservation()">Cancella Prenotazione</button>
                            </div>
                        </form>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Form nascosto per cancellazione -->
                        <form id="cancelForm" action="{{ route('reservations.cancel.token', $reservation->modification_token) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function cancelReservation() {
            if (confirm('Sei sicuro di voler cancellare questa prenotazione? Questa azione non può essere annullata.')) {
                document.getElementById('cancelForm').submit();
            }
        }
    </script>
</x-layout>
