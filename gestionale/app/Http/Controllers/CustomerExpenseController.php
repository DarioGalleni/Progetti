<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerExpenseController extends Controller
{
    public function showUpdateExpenses(Customer $customer)
    {
        $existingExpenses = $customer->expenses->keyBy('expense_type');
        return view('customers.update_expenses', compact('customer', 'existingExpenses'));
    }

    /**
     * Aggiorna le spese aggiuntive del cliente.
     */
    public function updateExpenses(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'expenses' => 'nullable|array',
            'expenses.*.amount' => 'nullable|numeric|min:0',
        ]);

        // $customer->expenses()->delete(); // Removed to allow adding to existing expenses

        if (!empty($data['expenses'])) {
            foreach ($data['expenses'] as $type => $item) {
                $amount = $item['amount'] ?? 0;
                if ($amount > 0) {
                    $existingExpense = $customer->expenses()->where('expense_type', $type)->first();

                    if ($existingExpense) {
                        $existingExpense->amount += $amount;
                        $existingExpense->save();
                    } else {
                        $customer->expenses()->create([
                            'expense_type' => $type,
                            'amount' => $amount,
                        ]);
                    }
                }
            }
        }

        return redirect()
            ->route('customers.show', $customer->id)
            ->with('success', 'Spese aggiuntive aggiornate con successo!');
    }
}