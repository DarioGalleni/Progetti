<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerExpense;
use Illuminate\Http\Request;

class CustomerExpenseController extends Controller
{
    /**
     * Show the form for updating additional expenses.
     */
    public function showUpdateExpenses(Customer $customer)
    {
        // Recupera le spese aggiuntive esistenti per il cliente
        $existingExpenses = $customer->expenses->keyBy('expense_type');

        // Passa il cliente e le spese alla vista
        return view('customers.update_expenses', compact('customer', 'existingExpenses'));
    }

    /**
     * Store or update additional expenses.
     */
    public function updateExpenses(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'expenses' => 'nullable|array',
            'expenses.*.amount' => 'nullable|numeric|min:0',
        ]);

        // Elimina le spese esistenti per evitare duplicati
        $customer->expenses()->delete();

        // Salva le nuove spese
        if (isset($validatedData['expenses'])) {
            foreach ($validatedData['expenses'] as $expenseType => $data) {
                if (isset($data['amount']) && $data['amount'] > 0) {
                    $customer->expenses()->create([
                        'expense_type' => $expenseType,
                        'amount' => $data['amount']
                    ]);
                }
            }
        }

        return redirect()->route('customers.show', $customer->id)->with('success', 'Spese aggiuntive aggiornate con successo!');
    }

    
}