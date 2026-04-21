<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|string',
            'message' => 'nullable|string'
        ]);

        if (\Illuminate\Support\Facades\Cache::get('reservations_blocked', false)) {
            return redirect('/#reservation')->with('error', 'Spiacenti, il ristorante è attualmente al completo e non accetta nuove prenotazioni online.');
        }

        Reservation::create($validated);

        return redirect('/#reservation')->with('success', 'Prenotazione accettata con successo!');
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required',
            'name' => 'required'
        ], [
            'phone.required' => 'Il numero di telefono è obbligatorio.',
            'name.required' => 'Il nome è obbligatorio.'
        ]);

        $phone = $validated['phone'];
        $name = $validated['name'];

        $reservation = Reservation::where('phone', $phone)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->orderBy('id', 'desc')->first();

        if ($reservation) {
            return redirect()->route('reservations.show', $reservation->id);
        }

        return redirect('/#home')->with('error', "Nessuna prenotazione trovata per il numero $phone e nome $name.");
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect('/')->with('success', 'Prenotazione cancellata con successo!');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }
}
