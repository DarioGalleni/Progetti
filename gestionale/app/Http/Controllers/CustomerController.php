<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('welcome', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'room' => 'required|integer',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:arrival_date',
            'treatment' => 'required|in:BB,HB,FB',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:customers,email',
            'number_of_people' => 'required|integer|min:1',
            'total_stay_cost' => 'required|numeric|min:0',
            'down_payment' => 'required|numeric|min:0',
            'additional_expenses' => 'nullable'
        ]);

        $existingBooking = Customer::where('room', $validatedData['room'])
            ->where(function ($query) use ($validatedData) {
                $query->where('arrival_date', '<', $validatedData['departure_date'])
                    ->where('departure_date', '>', $validatedData['arrival_date']);
            })
            ->first();

        if ($existingBooking) {
            return back()->withErrors(['room' => 'La camera selezionata è già occupata per il periodo richiesto.'])->withInput();
        }

        Customer::create($validatedData);

        return redirect()->route('welcome')->with('success', 'Cliente creato con successo!');
    }
    
    /**
     * Handle the customer search.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            // Se la query è vuota, potremmo reindirizzare alla home o mostrare una lista vuota
            // In questo caso, torniamo alla home
            return redirect()->route('welcome')->with('error', 'Inserisci un termine di ricerca.');
        }

        // Cerca i clienti che corrispondono al nome, cognome, telefono o email
        $customers = Customer::where('first_name', 'LIKE', '%' . $query . '%')
                             ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                             ->orWhere('phone', 'LIKE', '%' . $query . '%')
                             ->orWhere('email', 'LIKE', '%' . $query . '%')
                             ->get();

        // Passa i risultati della ricerca e la query alla nuova vista
        return view('customers.index', compact('customers', 'query'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'room' => 'required|integer',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:arrival_date',
            'treatment' => 'required|in:BB,HB,FB',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'number_of_people' => 'required|integer|min:1',
            'total_stay_cost' => 'required|numeric|min:0',
            'down_payment' => 'required|numeric|min:0',
        ]);

        $existingBooking = Customer::where('room', $validatedData['room'])
            ->where(function ($query) use ($validatedData) {
                $query->where('arrival_date', '<', $validatedData['departure_date'])
                    ->where('departure_date', '>', $validatedData['arrival_date']);
            })
            ->where('id', '!=', $customer->id)
            ->first();

        if ($existingBooking) {
            return back()->withErrors(['room' => 'La camera selezionata è già occupata per il periodo richiesto.'])->withInput();
        }

        $customer->update($validatedData);

        return redirect()->route('customers.show', $customer->id)->with('success', 'Dettagli cliente aggiornati con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('welcome')->with('success', 'Prenotazione eliminata con successo.');
    }

    /**
     * Display a list of customers departing today for billing.
     */
    public function todayDeparturesBilling()
    {
        $today = now()->toDateString();
        $departingCustomers = Customer::whereDate('departure_date', $today)->get();
        return view('customers.today-departures-billing', compact('departingCustomers'));
    }

    /**
     * Calculate and display the detailed bill for a customer.
     */
    public function showBill(Customer $customer)
    {
        $arrivalDate = Carbon::parse($customer->arrival_date);
        $departureDate = Carbon::parse($customer->departure_date);
        $totalDays = $arrivalDate->diffInDays($departureDate);
        $taxableDays = min($totalDays, 7);
        $cityTax = $taxableDays * 1.5 * $customer->number_of_people;
        $additionalExpensesTotal = $customer->expenses()->sum('amount');
        $grandTotal = $customer->total_stay_cost + $additionalExpensesTotal + $cityTax;
        $finalBalance = $grandTotal - $customer->down_payment;

        return view('customers.bill', compact(
            'customer',
            'cityTax',
            'additionalExpensesTotal',
            'grandTotal',
            'finalBalance'
        ));
    }
}