<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $rooms = config('rooms');

        // Escludo i gruppi
        $customers = Customer::where('arrival_date', '<=', $date->format('Y-m-d'))
            ->where('departure_date', '>=', $date->format('Y-m-d'))
            ->whereNull('group_id')
            ->get()
            ->groupBy('room_number');

        $restaurantData = [];
        $totalBreakfastPax = 0;
        $totalDinnerPax = 0;

        foreach ($rooms as $roomNumber => $roomName) {
            $roomCustomers = $customers->get($roomNumber);

            if (!$roomCustomers) {
                $restaurantData[$roomNumber] = null;
                continue;
            }

            // Ospite già presente (arrivo < oggi)
            $existingGuest = $roomCustomers->first(function ($c) use ($date) {
                return Carbon::parse($c->arrival_date)->startOfDay()->lt($date->copy()->startOfDay());
            });

            // Ospite in arrivo oggi
            $incomingGuest = $roomCustomers->first(function ($c) use ($date) {
                return Carbon::parse($c->arrival_date)->startOfDay()->eq($date->copy()->startOfDay());
            });

            $hasBreakfast = false;
            $hasDinner = false;
            $dinnerNote = '';
            $displayPax = 0;

            if ($existingGuest) {
                $displayPax = $existingGuest->pax;
            } elseif ($incomingGuest) {
                $displayPax = $incomingGuest->pax;
            }

            $breakfastPaxForThisRoom = 0;
            $dinnerPaxForThisRoom = 0;

            // Logica ospite esistente
            if ($existingGuest) {
                $treatment = strtoupper($existingGuest->treatment);
                $isDeparture = Carbon::parse($existingGuest->departure_date)->startOfDay()->eq($date->copy()->startOfDay());

                if ($treatment === 'BB') {
                    $hasBreakfast = true;
                    $breakfastPaxForThisRoom += $existingGuest->pax;
                } elseif ($treatment === 'HB' || $treatment === 'FB') {
                    $hasBreakfast = true;
                    $breakfastPaxForThisRoom += $existingGuest->pax;

                    // Cena solo se non è in partenza
                    if (!$isDeparture) {
                        $hasDinner = true;
                        $dinnerPaxForThisRoom += $existingGuest->pax;
                    }
                }
            }

            // Logica ospite in arrivo
            if ($incomingGuest) {
                $treatment = strtoupper($incomingGuest->treatment);
                $incomingPax = $incomingGuest->pax;

                if ($treatment === 'HB' || $treatment === 'FB') {
                    $hasDinner = true;
                    $dinnerPaxForThisRoom += $incomingPax;
                    $dinnerNote = "In arrivo ($incomingPax pax)";
                }
            }

            $totalBreakfastPax += $breakfastPaxForThisRoom;
            $totalDinnerPax += $dinnerPaxForThisRoom;

            $restaurantData[$roomNumber] = [
                'hasBreakfast' => $hasBreakfast,
                'hasDinner' => $hasDinner,
                'dinnerNote' => $dinnerNote,
                'pax' => $displayPax,
            ];
        }

        return view('restaurant.index', compact('date', 'rooms', 'restaurantData', 'totalBreakfastPax', 'totalDinnerPax'));
    }
}
