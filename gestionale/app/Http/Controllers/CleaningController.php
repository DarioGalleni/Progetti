<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;

class CleaningController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $rooms = config('rooms');

        $reservations = Customer::where(function ($q) use ($date) {
            $q->where('arrival_date', '<=', $date->format('Y-m-d'))
                ->where('departure_date', '>=', $date->format('Y-m-d'));
        })->get();

        $roomStatus = $this->calculateRoomStatus($rooms, $reservations, $date);

        return view('cleaning.index', compact('roomStatus', 'date', 'rooms'));
    }

    public function print(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $rooms = config('rooms');

        $reservations = Customer::where(function ($q) use ($date) {
            $q->where('arrival_date', '<=', $date->format('Y-m-d'))
                ->where('departure_date', '>=', $date->format('Y-m-d'));
        })->get();

        $roomStatus = $this->calculateRoomStatus($rooms, $reservations, $date);

        return view('cleaning.print', compact('roomStatus', 'date', 'rooms'));
    }

    private function calculateRoomStatus($rooms, $reservations, $date)
    {
        $roomStatus = [];

        foreach ($rooms as $roomNumber => $roomName) {
            $status = [
                'arrival' => null,
                'departure' => null,
                'stayover' => null,
            ];

            $roomRes = $reservations->where('room_number', (string) $roomNumber);

            foreach ($roomRes as $res) {
                $arr = Carbon::parse($res->arrival_date)->startOfDay();
                $dep = Carbon::parse($res->departure_date)->startOfDay();
                $target = $date->copy()->startOfDay();

                if ($dep->eq($target)) {
                    $status['departure'] = $res;
                }

                if ($arr->eq($target)) {
                    $status['arrival'] = $res;
                }

                if ($arr->lt($target) && $dep->gt($target)) {
                    $status['stayover'] = $res;
                }
            }

            $roomStatus[$roomNumber] = $status;
        }

        return $roomStatus;
    }
}
