<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        
        $reservations = Reservation::where('date', $date)
            ->orderBy('time', 'asc')
            ->get();

        $pranzo = $reservations->filter(function($res) {
            return \Carbon\Carbon::parse($res->time)->format('H:i') < '16:00';
        });

        $cena = $reservations->filter(function($res) {
            return \Carbon\Carbon::parse($res->time)->format('H:i') >= '16:00';
        });

        $reservationsBlocked = Cache::get('reservations_blocked', false);

        return view('dashboard', compact('pranzo', 'cena', 'date', 'reservationsBlocked'));
    }

    public function toggleReservations(Request $request)
    {
        $currentlyBlocked = Cache::get('reservations_blocked', false);
        Cache::put('reservations_blocked', !$currentlyBlocked);

        $status = !$currentlyBlocked ? 'bloccate' : 'sbloccate';
        return redirect()->back()->with('success', "Prenotazioni $status con successo.");
    }
}
