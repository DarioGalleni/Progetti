<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Show the form for creating a new group booking.
     */
    public function create()
    {
        // Get rooms from config
        $rooms = config('rooms');
        return view('groups.create', compact('rooms'));
    }

    /**
     * Store a newly created group booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:arrival_date|after_or_equal:tomorrow',
            'rooms' => 'required|array|min:1',
            'rooms.*' => 'integer',
        ], [
            'rooms.required' => 'Devi selezionare almeno una camera.',
            'arrival_date.after_or_equal' => 'La data di arrivo non può essere nel passato.',
            'departure_date.after' => 'La data di partenza deve essere successiva all\'arrivo.',
        ]);

        $rooms = $request->input('rooms');
        $arrivalDate = $request->input('arrival_date');
        $departureDate = $request->input('departure_date');
        $description = $request->input('description');

        // Check availability for ALL selected rooms first
        foreach ($rooms as $roomNumber) {
            $exists = \App\Models\Customer::where('room', $roomNumber)
                ->where('arrival_date', '<', $departureDate)
                ->where('departure_date', '>', $arrivalDate)
                ->exists();

            if ($exists) {
                return back()->withErrors(['rooms' => "La camera $roomNumber non è disponibile per il periodo selezionato."])->withInput();
            }
        }

        // Create bookings
        foreach ($rooms as $roomNumber) {
            \App\Models\Customer::create([
                'first_name' => 'Gruppo',
                'last_name' => $description,
                'room' => $roomNumber,
                'arrival_date' => $arrivalDate,
                'departure_date' => $departureDate,
                'treatment' => 'BB', // Default treatment
                'number_of_people' => 2, // Default pax
                'total_stay_cost' => 0,
                'is_group' => true,
            ]);
        }

        return redirect()->route('welcome')->with('success', 'Gruppo inserito con successo!');
    }
    /**
     * Show the form for editing the group.
     */
    public function edit(\App\Models\Customer $customer)
    {
        if (!$customer->is_group) {
            abort(404);
        }

        // Find common data
        // We assume group is identified by: is_group=true, last_name (desc), arrival, departure
        $siblings = \App\Models\Customer::where('is_group', true)
            ->where('last_name', $customer->last_name)
            ->where('arrival_date', $customer->arrival_date)
            ->where('departure_date', $customer->departure_date)
            ->get();

        $rooms = $siblings->pluck('room')->toArray();

        return view('groups.edit', compact('customer', 'rooms', 'siblings'));
    }

    /**
     * Update the group.
     */
    public function update(Request $request, \App\Models\Customer $customer)
    {
        if (!$customer->is_group) {
            abort(404);
        }

        $request->validate([
            'description' => 'required|string|max:255',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:arrival_date|after_or_equal:tomorrow',
        ]);

        $newDescription = $request->input('description');
        $newArrival = $request->input('arrival_date');
        $newDeparture = $request->input('departure_date');

        // Identify the group BEFORE update
        $query = \App\Models\Customer::where('is_group', true)
            ->where('last_name', $customer->last_name)
            ->where('arrival_date', $customer->arrival_date)
            ->where('departure_date', $customer->departure_date);

        $siblings = $query->get();

        // Check availability if dates changed
        if ($newArrival != $customer->arrival_date || $newDeparture != $customer->departure_date) {
            foreach ($siblings as $sibling) {
                $exists = \App\Models\Customer::where('room', $sibling->room)
                    ->where('id', '!=', $sibling->id) // Exclude self
                    ->where('arrival_date', '<', $newDeparture)
                    ->where('departure_date', '>', $newArrival)
                    ->exists();

                if ($exists) {
                    return back()->withErrors(['dates' => "La camera {$sibling->room} non è disponibile per le nuove date."])->withInput();
                }
            }
        }

        // Perform Update
        $query->update([
            'last_name' => $newDescription,
            'arrival_date' => $newArrival,
            'departure_date' => $newDeparture,
        ]);

        return redirect()->route('welcome')->with('success', 'Gruppo aggiornato con successo!');
    }

    /**
     * Remove the specified group from storage.
     */
    public function destroy(\App\Models\Customer $customer)
    {
        if (!$customer->is_group) {
            abort(404);
        }

        // Delete all bookings with same group attributes
        \App\Models\Customer::where('is_group', true)
            ->where('last_name', $customer->last_name)
            ->where('arrival_date', $customer->arrival_date)
            ->where('departure_date', $customer->departure_date)
            ->delete();

        return redirect()->route('welcome')->with('success', 'Gruppo eliminato con successo!');
    }
}
