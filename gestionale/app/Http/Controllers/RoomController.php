<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function todayDepartures()
    {
        $today = Carbon::today();

        $departingCustomers = Customer::whereDate('departure_date', $today)->get();
        $arrivingCustomers = Customer::whereDate('arrival_date', $today)->get();
        $stayingCustomers = Customer::whereDate('arrival_date', '<', $today)
            ->whereDate('departure_date', '>', $today)
            ->get();

        $departingRooms = $departingCustomers->pluck('room')->toArray();
        $arrivingRooms = $arrivingCustomers->pluck('room')->toArray();
        $stayingRooms = $stayingCustomers->pluck('room')->toArray();

        $allRooms = array_unique(array_merge($departingRooms, $arrivingRooms, $stayingRooms));
        sort($allRooms);

        return view(
            'rooms.today-departures',
            compact('departingRooms', 'arrivingRooms', 'stayingRooms', 'allRooms', 'today')
        );
    }
}