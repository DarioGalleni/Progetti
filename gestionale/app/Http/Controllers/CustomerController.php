<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $customers = match (true) {
            filled($query) => Customer::where('first_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('phone', 'like', "%{$query}%")
                ->latest()
                ->get(),
            default => collect([])
        };

        if (blank($query)) {
            $customers = Customer::latest()->paginate(20);
        }

        return view('customers.index', compact('customers', 'query'));
    }

    public function create()
    {
        $rooms = config('rooms');
        return view('customers.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $messages = [
            'first_name.required' => 'Il nome è obbligatorio.',
            'room_number.required' => 'La camera è obbligatoria.',
            'arrival_date.required' => 'La data di arrivo è obbligatoria.',
            'departure_date.required' => 'La data di partenza è obbligatoria.',
            'arrival_date.date' => 'La data di arrivo non è valida.',
            'arrival_date.after_or_equal' => 'La data di arrivo non può essere nel passato.',
            'departure_date.date' => 'La data di partenza non è valida.',
            'departure_date.after' => 'La data di partenza deve essere successiva alla data di arrivo.',
        ];

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'room_number' => 'required',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:arrival_date',
            'total_price' => 'nullable|numeric',
            'under_12_pax' => 'nullable|integer|min:0|lte:pax',
        ], $messages);

        $validated['under_12_pax'] = $validated['under_12_pax'] ?? 0;

        // Controllo conflitti
        $exists = Customer::where('room_number', $request->room_number)
            ->where('arrival_date', '<', $request->departure_date)
            ->where('departure_date', '>', $request->arrival_date)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'La camera è già occupata nelle date selezionate.');
        }

        Customer::create(array_merge($request->all(), $validated));

        return redirect('/')->with('success', 'Prenotazione creata con successo.');
    }

    public function show(Customer $customer)
    {
        $rooms = config('rooms');
        return view('customers.show', compact('customer', 'rooms'));
    }

    public function edit(Customer $customer)
    {
        $rooms = config('rooms');
        return view('customers.edit', compact('customer', 'rooms'));
    }

    public function update(Request $request, Customer $customer)
    {
        $messages = [
            'first_name.required' => 'Il nome è obbligatorio.',
            'room_number.required' => 'La camera è obbligatoria.',
            'arrival_date.required' => 'La data di arrivo è obbligatoria.',
            'departure_date.required' => 'La data di partenza è obbligatoria.',
            'arrival_date.date' => 'La data di arrivo non è valida.',
            'departure_date.date' => 'La data di partenza non è valida.',
            'departure_date.after' => 'La data di partenza deve essere successiva alla data di arrivo.',
            'under_12_pax.lte' => 'Il numero di minori non può superare il numero totale di persone.',
        ];

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'room_number' => 'required',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
            'total_price' => 'nullable|numeric',
            'under_12_pax' => 'nullable|integer|min:0|lte:pax',
        ], $messages);

        $validated['under_12_pax'] = $validated['under_12_pax'] ?? 0;

        // Controllo conflitti escludendo il cliente corrente
        $exists = Customer::where('room_number', $request->room_number)
            ->where('id', '!=', $customer->id)
            ->where('arrival_date', '<', $request->departure_date)
            ->where('departure_date', '>', $request->arrival_date)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'La camera è già occupata nelle date selezionate.');
        }

        $customer->update(array_merge($request->all(), $validated));

        return redirect()->route('customers.show', $customer)->with('success', 'Prenotazione aggiornata con successo.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('/')->with('success', 'Prenotazione eliminata con successo.');
    }
}
