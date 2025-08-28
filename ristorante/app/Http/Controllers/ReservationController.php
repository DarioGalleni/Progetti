<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Costanti per la gestione tavoli
    const TOTAL_TABLES = 20;
    const PEOPLE_PER_TABLE = 4;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedDate = $request->get('date', now()->format('Y-m-d'));
        
        // Prenotazioni per la data selezionata
        $reservations = Reservation::forDate($selectedDate)
            ->orderBy('time_slot')
            ->orderBy('time')
            ->get();
        
        // Raggruppa per slot temporale
        $lunchReservations = $reservations->where('time_slot', 'lunch');
        $dinnerReservations = $reservations->where('time_slot', 'dinner');
        
        // Calcola tavoli occupati per slot
        $lunchTablesOccupied = $lunchReservations->sum('tables_needed');
        $dinnerTablesOccupied = $dinnerReservations->sum('tables_needed');
        
        // Date con prenotazioni per il calendario (prossimi 90 giorni)
        $datesWithReservations = Reservation::where('date', '>=', now()->format('Y-m-d'))
            ->where('date', '<=', now()->addDays(90)->format('Y-m-d'))
            ->where('status', 'confirmed')
            ->selectRaw('DISTINCT date')
            ->pluck('date')
            ->map(fn($date) => $date->format('Y-m-d'))
            ->toArray();
        
        return view('reservations.index', compact(
            'selectedDate',
            'lunchReservations',
            'dinnerReservations',
            'lunchTablesOccupied',
            'dinnerTablesOccupied',
            'datesWithReservations'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'people' => 'required|integer|min:1|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500'
        ]);
        
        // Determina lo slot temporale
        $timeSlot = $this->determineTimeSlot($validated['time']);
        
        if (!$timeSlot) {
            return back()->withErrors(['time' => 'Orario non valido. Scegli un orario tra 12:00-13:45 (pranzo) o 19:30-22:00 (cena).']);
        }
        
        // Calcola tavoli necessari
        $tablesNeeded = Reservation::calculateTablesNeeded($validated['people']);
        
        // Verifica disponibilità
        if (!$this->checkAvailability($validated['date'], $timeSlot, $tablesNeeded)) {
            return back()->withErrors(['people' => 'Non ci sono abbastanza tavoli disponibili per la data e l\'orario selezionati.']);
        }
        
        // Crea la prenotazione
        $reservation = Reservation::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'people' => $validated['people'],
            'date' => $validated['date'],
            'time_slot' => $timeSlot,
            'time' => $validated['time'],
            'notes' => $validated['notes'],
            'tables_needed' => $tablesNeeded,
            'modification_token' => Str::random(32)
        ]);
        
        return redirect()->route('reservations.confirmation', $reservation->id)
            ->with('success', 'Prenotazione confermata con successo!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'people' => 'required|integer|min:1|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500'
        ]);
        
        // Determina lo slot temporale
        $timeSlot = $this->determineTimeSlot($validated['time']);
        
        if (!$timeSlot) {
            return back()->withErrors(['time' => 'Orario non valido. Scegli un orario tra 12:00-13:45 (pranzo) o 19:30-22:00 (cena).']);
        }
        
        // Calcola tavoli necessari
        $tablesNeeded = Reservation::calculateTablesNeeded($validated['people']);
        
        // Verifica disponibilità (escludendo la prenotazione corrente)
        if (!$this->checkAvailabilityExcluding($validated['date'], $timeSlot, $tablesNeeded, $reservation->id)) {
            return back()->withErrors(['people' => 'Non ci sono abbastanza tavoli disponibili per la data e l\'orario selezionati.']);
        }
        
        // Aggiorna la prenotazione
        $reservation->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'people' => $validated['people'],
            'date' => $validated['date'],
            'time_slot' => $timeSlot,
            'time' => $validated['time'],
            'notes' => $validated['notes'],
            'tables_needed' => $tablesNeeded,
        ]);
        
        return redirect()->route('reservations.confirmation', $reservation->id)
            ->with('success', 'Prenotazione aggiornata con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'cancelled']);
        
        return redirect()->route('reservations.index')
            ->with('success', 'Prenotazione cancellata con successo.');
    }

    /**
     * Modifica prenotazione tramite token email
     */
    public function modifyByToken($token)
    {
        $reservation = Reservation::where('modification_token', $token)
            ->where('status', 'confirmed')
            ->firstOrFail();
        
        return view('reservations.modify', compact('reservation'));
    }

    /**
     * Aggiorna prenotazione tramite token
     */
    public function updateByToken(Request $request, $token)
    {
        $reservation = Reservation::where('modification_token', $token)
            ->where('status', 'confirmed')
            ->firstOrFail();
            
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'people' => 'required|integer|min:1|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500'
        ]);
        
        $timeSlot = $this->determineTimeSlot($validated['time']);
        
        if (!$timeSlot) {
            return back()->withErrors(['time' => 'Orario non valido.']);
        }
        
        $tablesNeeded = Reservation::calculateTablesNeeded($validated['people']);
        
        if (!$this->checkAvailabilityExcluding($validated['date'], $timeSlot, $tablesNeeded, $reservation->id)) {
            return back()->withErrors(['people' => 'Non ci sono abbastanza tavoli disponibili.']);
        }
        
        $reservation->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'people' => $validated['people'],
            'date' => $validated['date'],
            'time_slot' => $timeSlot,
            'time' => $validated['time'],
            'notes' => $validated['notes'],
            'tables_needed' => $tablesNeeded,
        ]);
        
        return redirect()->route('reservations.confirmation', $reservation->id)
            ->with('success', 'Prenotazione modificata con successo!');
    }

    /**
     * Cancella prenotazione tramite token
     */
    public function cancelByToken($token)
    {
        $reservation = Reservation::where('modification_token', $token)
            ->where('status', 'confirmed')
            ->firstOrFail();
            
        $reservation->update(['status' => 'cancelled']);
        
        return view('reservations.destroy', compact('reservation'))
            ->with('success', 'Prenotazione cancellata con successo.');
    }

    /**
     * Mostra la conferma della prenotazione
     */
    public function confirmation($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        return view('reservations.confirmation', compact('reservation'));;
    }

    /**
     * Determina lo slot temporale basato sull'orario
     */
    private function determineTimeSlot($time)
    {
        $timeCarbon = Carbon::createFromFormat('H:i', $time);
        
        // Pranzo: 12:00 - 13:45
        if ($timeCarbon->between(Carbon::createFromFormat('H:i', '12:00'), Carbon::createFromFormat('H:i', '13:45'))) {
            return 'lunch';
        }
        
        // Cena: 19:30 - 22:00
        if ($timeCarbon->between(Carbon::createFromFormat('H:i', '19:30'), Carbon::createFromFormat('H:i', '22:00'))) {
            return 'dinner';
        }
        
        return null;
    }

    /**
     * Verifica la disponibilità dei tavoli
     */
    private function checkAvailability($date, $timeSlot, $tablesNeeded)
    {
        $occupiedTables = Reservation::forDate($date)
            ->forTimeSlot($timeSlot)
            ->sum('tables_needed');
        
        $availableTables = self::TOTAL_TABLES - $occupiedTables;
        
        return $availableTables >= $tablesNeeded;
    }

    /**
     * Verifica la disponibilità escludendo una prenotazione specifica
     */
    private function checkAvailabilityExcluding($date, $timeSlot, $tablesNeeded, $excludeReservationId)
    {
        $occupiedTables = Reservation::forDate($date)
            ->forTimeSlot($timeSlot)
            ->where('id', '!=', $excludeReservationId)
            ->sum('tables_needed');
        
        $availableTables = self::TOTAL_TABLES - $occupiedTables;
        
        return $availableTables >= $tablesNeeded;
    }

    /**
     * Mostra il modulo per la ricerca della prenotazione
     */
    public function find()
    {
        return view('reservations.find');
    }

    /**
     * Cerca una prenotazione per email o numero di telefono e reindirizza alla pagina di modifica
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'contact' => 'required|string|max:255'
        ]);
        
        $contact = $validated['contact'];
        
        // Rimuove gli spazi e i prefissi non numerici per i numeri di telefono
        $cleanedContact = preg_replace('/[^0-9]/', '', $contact);
        
        // Cerca la prenotazione per email o numero di telefono pulito
        $reservation = Reservation::where('email', $contact)
            ->orWhere('phone', $cleanedContact)
            ->where('status', 'confirmed')
            ->first();
        
        if ($reservation) {
            return redirect()->route('reservations.edit', $reservation->id);
        }
        
        return back()->withErrors(['contact' => 'Nessuna prenotazione trovata con le informazioni fornite.']);
    }
}