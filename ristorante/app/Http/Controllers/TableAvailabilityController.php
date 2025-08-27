<?php

namespace App\Http\Controllers;

use App\Models\TableAvailability;
use Illuminate\Http\Request;

class TableAvailabilityController extends Controller
{
    // Tutte le azioni sono ora riferite solo ai posti disponibili
    public function index()
    {
        $availabilities = TableAvailability::orderBy('date')->orderBy('time_slot')->get();
        return view('table_availability.index', compact('availabilities'));
    }

    public function show(TableAvailability $tableAvailability)
    {
        return view('table_availability.show', compact('tableAvailability'));
    }

    public function update(Request $request, TableAvailability $tableAvailability)
    {
        $validated = $request->validate([
            'available_seats' => 'required|integer|min:0',
        ]);
        $tableAvailability->available_seats = $validated['available_seats'];
        $tableAvailability->save();
        return redirect()->route('table_availability.index')->with('success', 'Posti aggiornati con successo.');
    }

    public function destroy(TableAvailability $tableAvailability)
    {
        $tableAvailability->delete();
        return redirect()->route('table_availability.index')->with('success', 'Disponibilità rimossa.');
    }
}
