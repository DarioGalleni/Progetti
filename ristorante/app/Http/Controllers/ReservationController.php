<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\TableAvailability;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('customer')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date'  => 'required|date|after_or_equal:today',
            'time'  => 'required',
            'people'=> 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $timeObj = Carbon::createFromFormat('H:i', $validated['time']);
        $isValidTime = ($timeObj->hour >= 12 && $timeObj->hour <= 14) || ($timeObj->hour >= 19 && $timeObj->hour <= 23);
        if (! $isValidTime) {
            return redirect()->back()->withErrors([
                'time' => 'Il ristorante è aperto dalle 12 alle 14 e dalle 19 alle 23.'
            ])->withInput();
        }

        $tablesRequired = Reservation::calculateTablesRequired($validated['people']);

        DB::beginTransaction();
        try {
            $availability = TableAvailability::where('date', $validated['date'])
                ->where('time_slot', $validated['time'])
                ->lockForUpdate()
                ->first();

            if (! $availability) {
                $availability = TableAvailability::create([
                    'date' => $validated['date'],
                    'time_slot' => $validated['time'],
                    'available_tables' => 20,
                ]);
            }

            if ($availability->available_tables < $tablesRequired) {
                DB::rollBack();
                return redirect()->back()->withErrors([
                    'availability' => 'Ci dispiace, non ci sono abbastanza tavoli disponibili per questo orario.'
                ])->withInput();
            }

            $availability->available_tables = max(0, $availability->available_tables - $tablesRequired);
            $availability->save();

            $customer = Customer::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                ]
            );

            $reservation = Reservation::create([
                'customer_id' => $customer->id,
                'date' => $validated['date'],
                'time' => $validated['time'],
                'people' => $validated['people'],
                'tables_required' => $tablesRequired,
                'notes' => $validated['notes'] ?? null,
            ]);

            DB::commit();
            return redirect()->route('reservation.confirmation', ['reservation' => $reservation]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Errore durante la creazione della prenotazione.'])->withInput();
        }
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date'  => 'required|date|after_or_equal:today',
            'time'  => 'required',
            'people'=> 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $timeObj = Carbon::createFromFormat('H:i', $validated['time']);
        $isValidTime = ($timeObj->hour >= 12 && $timeObj->hour <= 14) || ($timeObj->hour >= 19 && $timeObj->hour <= 23);
        if (! $isValidTime) {
            return redirect()->back()->withErrors([
                'time' => 'Il ristorante è aperto dalle 12 alle 14 e dalle 19 alle 23.'
            ])->withInput();
        }

        $newTablesRequired = Reservation::calculateTablesRequired($validated['people']);

        DB::beginTransaction();
        try {
            $oldAvail = TableAvailability::where('date', $reservation->date)
                ->where('time_slot', $reservation->time)
                ->lockForUpdate()
                ->first();

            if (! $oldAvail) {
                $oldAvail = TableAvailability::create([
                    'date' => $reservation->date,
                    'time_slot' => $reservation->time,
                    'available_tables' => 20,
                ]);
            }
            $oldAvail->available_tables = min(20, $oldAvail->available_tables + $reservation->tables_required);
            $oldAvail->save();

            $newAvail = TableAvailability::where('date', $validated['date'])
                ->where('time_slot', $validated['time'])
                ->lockForUpdate()
                ->first();

            if (! $newAvail) {
                $newAvail = TableAvailability::create([
                    'date' => $validated['date'],
                    'time_slot' => $validated['time'],
                    'available_tables' => 20,
                ]);
            }

            if ($newAvail->available_tables < $newTablesRequired) {
                DB::rollBack();
                return redirect()->back()->withErrors([
                    'availability' => 'Ci dispiace, non ci sono abbastanza tavoli disponibili per il nuovo orario.'
                ])->withInput();
            }

            $newAvail->available_tables = max(0, $newAvail->available_tables - $newTablesRequired);
            $newAvail->save();

            $customer = Customer::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                ]
            );

            $reservation->update([
                'customer_id' => $customer->id,
                'date' => $validated['date'],
                'time' => $validated['time'],
                'people' => $validated['people'],
                'tables_required' => $newTablesRequired,
                'notes' => $validated['notes'] ?? null,
            ]);

            DB::commit();
            return redirect()->route('reservations.index')->with('success', 'Prenotazione aggiornata correttamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Errore durante l\'aggiornamento della prenotazione.'])->withInput();
        }
    }

    public function show(Reservation $reservation)
    {
        //
    }

    public function destroy(Reservation $reservation)
    {
        DB::beginTransaction();
        try {
            $avail = TableAvailability::where('date', $reservation->date)
                ->where('time_slot', $reservation->time)
                ->lockForUpdate()
                ->first();

            if (! $avail) {
                $avail = TableAvailability::create([
                    'date' => $reservation->date,
                    'time_slot' => $reservation->time,
                    'available_tables' => 20,
                ]);
            }

            $avail->available_tables = min(20, $avail->available_tables + $reservation->tables_required);
            $avail->save();

            $reservation->delete();

            DB::commit();
            return redirect()->route('reservations.index')->with('success', 'Prenotazione cancellata e tavoli liberati.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Errore durante la cancellazione della prenotazione.']);
        }
    }

    /**
     * Mostra la pagina di conferma della prenotazione.
     *
     * @param Reservation $reservation
     * @return \Illuminate\View\View
     */
    public function confirmation(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }
}
