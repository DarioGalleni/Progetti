<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReceptionController extends Controller
{
    public function arrivals(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();

        $arrivals = Customer::whereDate('arrival_date', $date->format('Y-m-d'))
            ->whereNull('group_id')
            ->orderBy('room_number')
            ->get();

        return view('reception.arrivals', compact('date', 'arrivals'));
    }

    public function departures(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();

        $departures = Customer::whereDate('departure_date', $date->format('Y-m-d'))
            ->whereNull('group_id')
            ->orderBy('room_number')
            ->get();

        return view('reception.departures', compact('date', 'departures'));
    }
}
