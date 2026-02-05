<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $centerDate = $request->has('date') ? Carbon::parse($request->date) : Carbon::today();
        $startDate = $centerDate->copy()->subMonths(12);
        $endDate = $centerDate->copy()->addMonths(12);

        $dates = [];
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->copy();
        }

        $rooms = config('rooms');

        $reservationsRaw = Customer::where('departure_date', '>', $startDate->format('Y-m-d'))
            ->where('arrival_date', '<', $endDate->format('Y-m-d'))
            ->get();

        // Costruisce griglia di lookup O(1): [numero_camera][data] => Prenotazione
        $dailyReservations = [];

        foreach ($reservationsRaw as $res) {
            $rStart = Carbon::parse($res->arrival_date);
            $rEnd = Carbon::parse($res->departure_date);
            $loopStart = $rStart->max($startDate);
            $loopEnd = $rEnd->min($endDate);
            $curr = $loopStart->copy();

            while ($curr->lt($rEnd) && $curr->lte($endDate)) {
                $dailyReservations[$res->room_number][$curr->format('Y-m-d')] = $res;
                $curr->addDay();
            }
        }

        return view('welcome', compact('rooms', 'dates', 'dailyReservations', 'centerDate'));
    }
}
