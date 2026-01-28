<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display the welcome calendar.
     */
    public function welcome(Request $request)
    {
        $selectedMonth = $request->input('month')
            ? Carbon::parse($request->input('month'))
            : Carbon::now();

        $customers = Customer::all();

        return view('welcome', compact('customers', 'selectedMonth'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
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


        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'room' => 'required|integer',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:arrival_date|after_or_equal:tomorrow',
            'treatment' => 'required|in:BB,HB',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'number_of_people' => 'nullable|integer|min:1',
            'total_stay_cost' => 'required|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'additional_notes' => 'nullable|string',
            'is_booking' => 'nullable|boolean',
            'is_cash_payment' => 'nullable|boolean',
        ]);

        // Check for availability
        $exists = Customer::where('room', $request->room)
            ->where('arrival_date', '<', $request->departure_date)
            ->where('departure_date', '>', $request->arrival_date)
            ->exists();

        if ($exists) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'room' => "La camera {$request->room} è già occupata in questo periodo.",
            ]);
        }

        $validated['is_booking'] = $request->boolean('is_booking');
        $validated['is_cash_payment'] = $request->boolean('is_cash_payment');

        Customer::create($validated);

        return redirect()->route('welcome')->with('success', 'Cliente aggiunto con successo!');
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
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // "tutte le modifiche dei record sono concesse fin alla data di partenza"
        // Se la data di partenza è passata (ieri o prima), blocca la modifica.
        if (Carbon::now()->startOfDay()->gt(Carbon::parse($customer->departure_date))) {
            return redirect()->back()->with('error', 'Non è possibile modificare prenotazioni già concluse.');
        }


        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'room' => 'required|integer',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date|after_or_equal:today',
            'treatment' => 'required|in:BB,HB',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'number_of_people' => 'nullable|integer|min:1',
            'total_stay_cost' => 'required|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'additional_notes' => 'nullable|string',
            'is_booking' => 'nullable|boolean',
            'is_cash_payment' => 'nullable|boolean',
        ]);

        $validated['is_booking'] = $request->boolean('is_booking');
        $validated['is_cash_payment'] = $request->boolean('is_cash_payment');

        $customer->update($validated);

        return redirect()->route('welcome')->with('success', "Il cliente {$customer->first_name} {$customer->last_name} è stato modificato.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('welcome')->with('error', 'Cliente eliminato con successo!');
    }

    /**
     * Search for customers.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $customers = Customer::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return view('customers.index', compact('customers', 'query'));
    }

    /**
     * Show billing for today's departures.
     */
    public function todayDeparturesBilling(Request $request)
    {
        $today = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $departingCustomers = Customer::whereDate('departure_date', $today)->get();
        return view('customers.departures', compact('departingCustomers', 'today'));
    }

    /**
     * Show arrivals for a specific date.
     */
    public function arrivals(Request $request)
    {
        $today = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $arrivingCustomers = Customer::whereDate('arrival_date', $today)->get();
        return view('customers.arrivals', compact('arrivingCustomers', 'today'));
    }

    /**
     * Print departures for a specific date.
     */
    public function printDepartures(Request $request)
    {
        $today = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $departingCustomers = Customer::whereDate('departure_date', $today)->get();
        return view('customers.departures-print', compact('departingCustomers', 'today'));
    }

    /**
     * Print arrivals for a specific date.
     */
    public function printArrivals(Request $request)
    {
        $today = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $arrivingCustomers = Customer::whereDate('arrival_date', $today)->get();
        return view('customers.arrivals-print', compact('arrivingCustomers', 'today'));
    }

    /**
     * Show the bill for the customer.
     */
    public function showBill(Customer $customer)
    {

        $arrival = Carbon::parse($customer->arrival_date);
        $departure = Carbon::parse($customer->departure_date);
        $nights = $arrival->diffInDays($departure);
        $taxRate = 1.50;
        $cityTax = $nights * $customer->number_of_people * $taxRate;
        $additionalExpenses = $customer->expenses->sum('amount');
        $grandTotal = $customer->total_stay_cost + $cityTax + $additionalExpenses;
        $finalBalance = $grandTotal - $customer->down_payment;

        return view('customers.bill', compact(
            'customer',
            'cityTax',
            'additionalExpenses',
            'grandTotal',
            'finalBalance'
        ));
    }

    /**
     * Print the bill (HTML view).
     */
    public function printBill(Customer $customer)
    {
        $arrival = Carbon::parse($customer->arrival_date);
        $departure = Carbon::parse($customer->departure_date);
        $nights = $arrival->diffInDays($departure);

        $taxRate = 1.50;
        $cityTax = $nights * $customer->number_of_people * $taxRate;

        $additionalExpenses = $customer->expenses->sum('amount');

        $grandTotal = $customer->total_stay_cost + $cityTax + $additionalExpenses;
        $finalBalance = $grandTotal - $customer->down_payment;

        return view('customers.bill_html', compact(
            'customer',
            'cityTax',
            'additionalExpenses',
            'grandTotal',
            'finalBalance'
        ));
    }

    /**
     * Print the receipt (HTML view).
     */
    public function printReceipt(Customer $customer)
    {
        $arrival = Carbon::parse($customer->arrival_date);
        $departure = Carbon::parse($customer->departure_date);
        $nights = $arrival->diffInDays($departure);

        $taxRate = 1.50;
        $cityTax = $nights * $customer->number_of_people * $taxRate;

        $additionalExpenses = $customer->expenses->sum('amount');

        $grandTotal = $customer->total_stay_cost + $cityTax + $additionalExpenses;
        $finalBalance = $grandTotal - $customer->down_payment;

        return view('customers.receipt_html', compact(
            'customer',
            'cityTax',
            'additionalExpenses',
            'grandTotal',
            'finalBalance'
        ));
    }
}
