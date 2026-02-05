<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class BillingController extends Controller
{
    public function expenses(Customer $customer)
    {
        $expenses = $customer->expenses()->latest()->get();
        $totals = $customer->expenses()
            ->selectRaw('description, SUM(amount) as total')
            ->groupBy('description')
            ->pluck('total', 'description')
            ->toArray();

        $beverageTypes = ['Vino', 'Acqua', 'Bar', 'Bibite', 'Amari', 'Aperitivi'];
        $beverageTotal = 0;
        foreach ($totals as $desc => $amount) {
            if ($desc === 'Bevande' || in_array($desc, $beverageTypes)) {
                $beverageTotal += $amount;
            }
        }

        return view('billing.expenses', compact('customer', 'expenses', 'totals', 'beverageTotal', 'beverageTypes'));
    }

    public function storeExpense(Request $request, Customer $customer)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        $customer->expenses()->create([
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return back()->with('success', 'Spesa aggiunta con successo.');
    }

    public function updateExpenses(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'expenses' => 'required|array',
            'expenses.*.amount' => 'nullable|numeric',
            'expenses.*.type' => 'nullable|string',
        ]);

        $count = 0;
        foreach ($data['expenses'] as $key => $values) {
            $amount = $values['amount'];
            if ($amount !== null && $amount != 0) {
                $description = ucfirst(str_replace('_', ' ', $key));

                if (!empty($values['type'])) {
                    $description = ucfirst($values['type']);
                }

                $customer->expenses()->create([
                    'description' => $description,
                    'amount' => $amount,
                ]);
                $count++;
            }
        }

        if ($count > 0) {
            return back()->with('success', "$count voci di spesa aggiornate.");
        }

        return back()->with('info', "Nessuna modifica effettuata.");
    }

    public function printExpenses(Customer $customer)
    {
        $expenses = $customer->expenses()->oldest()->get();
        return view('billing.print-expenses', compact('customer', 'expenses'));
    }

    public function printBill(Customer $customer)
    {
        $data = $this->calculateBillingData($customer);
        return view('billing.print-bill', $data);
    }

    public function receipt(Customer $customer)
    {
        $data = $this->calculateBillingData($customer);
        $data['grandTotal'] = $customer->total_price + $data['extrasTotal'] + $data['touristTax'];

        return view('billing.receipt', $data);
    }

    public function mobileExtrasIndex()
    {
        $today = now()->startOfDay();
        $customers = Customer::whereDate('arrival_date', '<=', $today)
            ->whereDate('departure_date', '>=', $today)
            ->orderBy('room_number')
            ->get();

        return view('billing.mobile-extras-index', compact('customers'));
    }

    public function mobileExtrasShow(Customer $customer)
    {
        $categories = [
            'pasti' => 'bi bi-egg-fried',
            'bevande' => 'bi bi-cup-straw'
        ];

        $beverageTypes = ['Vino', 'Acqua', 'Bar', 'Bibite', 'Amari', 'Aperitivi'];

        $rawTotals = $customer->expenses()
            ->selectRaw('description, SUM(amount) as total')
            ->groupBy('description')
            ->pluck('total', 'description')
            ->toArray();

        $totals = [];
        $totals['Pasti'] = $rawTotals['Pasti'] ?? 0;
        $totals['Bevande'] = $rawTotals['Bevande'] ?? 0;

        foreach ($beverageTypes as $type) {
            if (isset($rawTotals[$type])) {
                $totals['Bevande'] += $rawTotals[$type];
            }
        }

        $descriptionFilter = array_merge(['Pasti', 'Bevande'], $beverageTypes);

        $recentMovements = $customer->expenses()
            ->whereIn('description', $descriptionFilter)
            ->latest()
            ->take(5)
            ->get();

        return view('billing.mobile-extras-show', compact('customer', 'categories', 'totals', 'recentMovements', 'beverageTypes'));
    }

    private function calculateBillingData(Customer $customer)
    {
        $start = \Carbon\Carbon::parse($customer->arrival_date);
        $end = \Carbon\Carbon::parse($customer->departure_date);
        $days = $start->diffInDays($end);

        // Imposta di soggiorno: 1.50€ a persona/giorno, max 7 giorni (esclusi minori di 12 anni)
        $taxableDays = min($days, 7);
        $taxablePax = max(0, $customer->pax - ($customer->under_12_pax ?? 0));
        $touristTax = $taxablePax * 1.50 * $taxableDays;

        $stayPrice = $customer->total_price;
        $deposit = $customer->deposit ?? 0;
        $expenses = $customer->expenses;
        $extrasTotal = $expenses->sum('amount');
        $grandTotal = ($stayPrice - $deposit) + $extrasTotal + $touristTax;

        return compact(
            'customer',
            'days',
            'touristTax',
            'taxableDays',
            'taxablePax',
            'expenses',
            'extrasTotal',
            'grandTotal'
        );
    }
}
