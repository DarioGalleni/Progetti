<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected function rules($customerId = null): array
    {
        $uniqueEmail = 'unique:customers,email' . ($customerId ? ",$customerId" : '');

        return [
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'room'             => 'required|integer',
            'arrival_date'     => 'required|date',
            'departure_date'   => 'required|date|after:arrival_date',
            'treatment'        => 'required|in:BB,HB',
            'phone'            => 'nullable|string|max:20',
            'email'            => "required|email|$uniqueEmail",
            'number_of_people' => 'required|integer|min:1',
            'total_stay_cost'  => 'required|numeric|min:1',
            'down_payment'     => 'numeric',
        ];
    }

    protected function isRoomAvailable(int $room, string $arrival, string $departure, int $excludeId = null): bool
    {
        $query = Customer::where('room', $room)
            ->where(function ($q) use ($arrival, $departure) {
                $q->where('arrival_date', '<', $departure)
                    ->where('departure_date', '>', $arrival);
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return !$query->exists();
    }

    /**
     * Controlla errori sulle date di prenotazione.
     */
    protected function bookingDateErrors(array $data, bool $isUpdate = false): array
    {
        $errors = [];
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $currentYear = $today->year;

        $arrival = Carbon::parse($data['arrival_date']);
        $departure = Carbon::parse($data['departure_date']);

        // Solo in creazione blocca arrivi prima di oggi
        if (!$isUpdate && $arrival->lt($today)) {
            $errors['arrival_date'] = 'La data di arrivo non può essere antecedente alla data odierna.';
        }

        // Solo in creazione la partenza deve essere almeno domani, in modifica può essere anche oggi
        if (!$isUpdate && $departure->lt($tomorrow)) {
            $errors['departure_date'] = 'La data di partenza deve essere almeno il giorno successivo.';
        }
        if ($isUpdate && $departure->lt($today)) {
            $errors['departure_date'] = 'La data di partenza non può essere antecedente alla data odierna.';
        }

        if ($arrival->year !== $currentYear || $departure->year !== $currentYear) {
            $errors['year'] = "Le prenotazioni sono consentite solo per l'anno corrente ({$currentYear}).";
        }

        return $errors;
    }

    public function index()
    {
        $customers = Customer::all();
        return view('welcome', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        $dateErrors = $this->bookingDateErrors($data);
        if (!empty($dateErrors)) {
            return back()->withErrors($dateErrors)->withInput();
        }

        if (!$this->isRoomAvailable($data['room'], $data['arrival_date'], $data['departure_date'])) {
            return back()
                ->withErrors(['room' => 'La camera selezionata è già occupata per il periodo richiesto.'])
                ->withInput();
        }

        Customer::create($data);

        return redirect()->route('welcome')->with('success', 'Cliente creato con successo!');
    }

    public function search(Request $request)
    {
        $query = trim($request->input('query', ''));

        if ($query === '') {
            return redirect()->route('welcome')->with('error', 'Inserisci un termine di ricerca.');
        }

        $customers = Customer::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();

        return view('customers.index', ['customers' => $customers, 'query' => $query]);
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate($this->rules($customer->id));

        // Passa true per consentire arrivo antecedente ad oggi in modifica
        $dateErrors = $this->bookingDateErrors($data, true);
        if (!empty($dateErrors)) {
            return back()->withErrors($dateErrors)->withInput();
        }

        if (!$this->isRoomAvailable($data['room'], $data['arrival_date'], $data['departure_date'], $customer->id)) {
            return back()
                ->withErrors(['room' => 'La camera selezionata è già occupata per il periodo richiesto.'])
                ->withInput();
        }

        $customer->update($data);

        return redirect()->route('customers.show', $customer->id)->with('success', 'Dettagli cliente aggiornati con successo!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('welcome')->with('success', 'Prenotazione eliminata con successo.');
    }

    public function showTodayDeparturesBilling()
    {
        $today = Carbon::today();
        $departingCustomers = Customer::whereDate('departure_date', $today)->get();

        return view('customers.today-departures-billing', [
            'departingCustomers' => $departingCustomers,
            'today' => $today
        ]);
    }

    public function showBill(Customer $customer)
    {
        $arrival = Carbon::parse($customer->arrival_date);
        $departure = Carbon::parse($customer->departure_date);
        $totalDays = max(0, $arrival->diffInDays($departure));
        $taxableDays = min($totalDays, 7);
        $cityTax = 1.5 * $customer->number_of_people * $taxableDays;
        $additionalExpenses = $customer->expenses()->sum('amount') ?? 0;
        $grandTotal = $customer->total_stay_cost + $additionalExpenses + $cityTax;
        $finalBalance = $grandTotal - $customer->down_payment;

        return view('customers.bill', compact(
            'customer',
            'cityTax',
            'additionalExpenses',
            'grandTotal',
            'finalBalance',
        ));
    }
}