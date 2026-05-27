<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $selectRaw = 'MIN(id) as id, MAX(group_id) as group_id, MAX(first_name) as first_name, MAX(last_name) as last_name, MAX(email) as email, MAX(phone) as phone, MAX(arrival_date) as arrival_date, MAX(departure_date) as departure_date, SUM(pax) as pax, MAX(treatment) as treatment, MAX(group_name) as group_name, MAX(room_number) as room_number';

        $customers = match (true) {
            filled($query) => Customer::selectRaw($selectRaw)
                ->where(function ($q) use ($query) {
                    $q->where('first_name', 'like', "%{$query}%")
                        ->orWhere('last_name', 'like', "%{$query}%")
                        ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"])
                        ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$query}%"])
                        ->orWhere('email', 'like', "%{$query}%")
                        ->orWhere('phone', 'like', "%{$query}%")
                        ->orWhere('group_name', 'like', "%{$query}%");
                })
                ->groupByRaw('COALESCE(group_id, id)')
                ->orderBy('arrival_date', 'asc')
                ->get(),
            default => collect([])
        };

        if (blank($query)) {
            $today = now()->toDateString();
            $customers = Customer::selectRaw($selectRaw)
                ->groupByRaw('COALESCE(group_id, id)')
                ->orderByRaw('CASE WHEN MAX(arrival_date) < ? THEN 1 ELSE 0 END ASC', [$today])
                ->orderBy('arrival_date', 'asc')
                ->paginate(50);
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

        return back()->with('success', 'Prenotazione creata con successo.');
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

        return back()->with('success', 'Prenotazione aggiornata con successo.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('/')->with('success', 'Prenotazione eliminata con successo.');
    }
}
