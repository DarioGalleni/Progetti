<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerExpense;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function welcome()
    {
        $customers = Customer::all();
        return view('welcome', compact('customers'));
    }

    /**
     * Esegue il comando artisan optimize:clear e ritorna alla pagina precedente con un messaggio.
     */
    public function optimizeClear()
    {
        Artisan::call('optimize:clear');
        return redirect()->back()->with('status', 'Cache e file ottimizzati rimossi.');
    }
}