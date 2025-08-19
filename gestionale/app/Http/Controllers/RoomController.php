<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function todayDepartures()
    {
        $today = now()->toDateString();
        
        // Clienti in PARTENZA oggi
        $departingCustomers = Customer::whereDate('departure_date', $today)->get();
        
        // Clienti in ARRIVO oggi
        $arrivingCustomers = Customer::whereDate('arrival_date', $today)->get();

        // Clienti IN FERMO: arrivati prima di oggi E in partenza dopo oggi
        $stayingCustomers = Customer::whereDate('arrival_date', '<', $today)
                                    ->whereDate('departure_date', '>', $today)
                                    ->get();

        // Estrai i numeri di camera per ogni stato
        $departingRooms = $departingCustomers->pluck('room')->toArray();
        $arrivingRooms = $arrivingCustomers->pluck('room')->toArray();
        $stayingRooms = $stayingCustomers->pluck('room')->toArray();
        
        // Unisci tutte le camere coinvolte (partenze, arrivi, fermo) per avere una lista unica
        $allRooms = array_unique(array_merge($departingRooms, $arrivingRooms, $stayingRooms));
        sort($allRooms);

        return view('rooms.today-departures', compact('departingRooms', 'arrivingRooms', 'stayingRooms', 'allRooms'));
    }
}