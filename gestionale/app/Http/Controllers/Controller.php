<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerExpense;
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

}