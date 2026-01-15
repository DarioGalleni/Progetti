<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    /**
     * Mostra le camere con partenze, arrivi e soggiorni odierni.
     */
    public function todayDepartures(Request $request)
    {
        $today = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();

        $departingCustomers = Customer::whereDate('departure_date', $today)->get();
        $arrivingCustomers = Customer::whereDate('arrival_date', $today)->get();
        $stayingCustomers = Customer::whereDate('arrival_date', '<', $today)
            ->whereDate('departure_date', '>', $today)
            ->get();

        $roomStatus = [];

        // Map departing rooms
        foreach ($departingCustomers as $customer) {
            $roomStatus[$customer->room]['departing'] = true;
        }

        // Map arriving rooms with pax count
        foreach ($arrivingCustomers as $customer) {
            $roomStatus[$customer->room]['arriving'] = true;
            $roomStatus[$customer->room]['arriving_pax'] = $customer->number_of_people;
        }

        // Map staying rooms
        foreach ($stayingCustomers as $customer) {
            $roomStatus[$customer->room]['staying'] = true;
        }

        // Sort by room number
        ksort($roomStatus);

        return view(
            'rooms.today-departures',
            compact('roomStatus', 'today')
        );
    }

    /**
     * Stampa lo stato delle camere odierno.
     */
    public function printTodayDepartures(Request $request)
    {
        $today = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();

        $departingCustomers = Customer::whereDate('departure_date', $today)->get();
        $arrivingCustomers = Customer::whereDate('arrival_date', $today)->get();
        $stayingCustomers = Customer::whereDate('arrival_date', '<', $today)
            ->whereDate('departure_date', '>', $today)
            ->get();

        $roomStatus = [];

        // Map departing rooms
        foreach ($departingCustomers as $customer) {
            $roomStatus[$customer->room]['departing'] = true;
        }

        // Map arriving rooms with pax count
        foreach ($arrivingCustomers as $customer) {
            $roomStatus[$customer->room]['arriving'] = true;
            $roomStatus[$customer->room]['arriving_pax'] = $customer->number_of_people;
        }

        // Map staying rooms
        foreach ($stayingCustomers as $customer) {
            $roomStatus[$customer->room]['staying'] = true;
        }

        // Sort by room number
        ksort($roomStatus);

        return view(
            'rooms.today-departures-print',
            compact('roomStatus', 'today')
        );
    }

    /**
     * Mostra la dashboard del ristorante con colazioni e cene per data specifica
     */
    public function restaurant(Request $request)
    {
        $selectedDate = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();

        // Camere in partenza nella data selezionata
        $departingCustomers = Customer::whereDate('departure_date', $selectedDate)->get();

        // Camere in arrivo nella data selezionata
        $arrivingCustomers = Customer::whereDate('arrival_date', $selectedDate)->get();

        // Camere in soggiorno (arrivo prima della data, partenza dopo)
        $stayingCustomers = Customer::whereDate('arrival_date', '<', $selectedDate)
            ->whereDate('departure_date', '>', $selectedDate)
            ->get();

        // Raggruppo per camera
        $roomData = [];

        // Elaboro camere in partenza (sempre colazione)
        foreach ($departingCustomers as $customer) {
            $roomData[$customer->room] = [
                'number_of_people' => $customer->number_of_people,
                'breakfast' => true, // Chi parte fa sempre colazione
                'dinner' => false,
                'status' => 'departing',
                'treatment' => $customer->treatment
            ];
        }

        // Elaboro camere in arrivo (solo HB per cena, BB non viene mostrato)
        foreach ($arrivingCustomers as $customer) {
            // Salto gli arrivi in BB - non devono essere mostrati
            if ($customer->treatment === 'BB') {
                continue;
            }

            if (isset($roomData[$customer->room])) {
                // Camera che parte e arriva lo stesso giorno
                if ($customer->treatment === 'HB') {
                    $roomData[$customer->room]['dinner'] = true;
                    $roomData[$customer->room]['status'] = 'departing_arriving';
                    $roomData[$customer->room]['arriving_people'] = $customer->number_of_people;
                }
            } else {
                // Solo arrivo HB (gli arrivi BB sono già stati esclusi sopra)
                $roomData[$customer->room] = [
                    'number_of_people' => $customer->number_of_people,
                    'breakfast' => false,
                    'dinner' => true, // Se siamo qui è sicuramente HB
                    'status' => 'arriving',
                    'treatment' => $customer->treatment
                ];
            }
        }

        // Elaboro camere in soggiorno
        foreach ($stayingCustomers as $customer) {
            if (!isset($roomData[$customer->room])) {
                $roomData[$customer->room] = [
                    'number_of_people' => $customer->number_of_people,
                    'breakfast' => true, // Chi soggiorna fa sempre colazione
                    'dinner' => $customer->treatment === 'HB',
                    'status' => 'staying',
                    'treatment' => $customer->treatment
                ];
            }
        }

        // Ordino per numero camera
        ksort($roomData);

        return view('customers.restaurant', compact('roomData', 'selectedDate'));
    }

    /**
     * Stampa la dashboard del ristorante.
     */
    public function printRestaurant(Request $request)
    {
        $selectedDate = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();

        // Camere in partenza nella data selezionata
        $departingCustomers = Customer::whereDate('departure_date', $selectedDate)->get();

        // Camere in arrivo nella data selezionata
        $arrivingCustomers = Customer::whereDate('arrival_date', $selectedDate)->get();

        // Camere in soggiorno (arrivo prima della data, partenza dopo)
        $stayingCustomers = Customer::whereDate('arrival_date', '<', $selectedDate)
            ->whereDate('departure_date', '>', $selectedDate)
            ->get();

        // Raggruppo per camera
        $roomData = [];

        // Elaboro camere in partenza (sempre colazione)
        foreach ($departingCustomers as $customer) {
            $roomData[$customer->room] = [
                'number_of_people' => $customer->number_of_people,
                'breakfast' => true, // Chi parte fa sempre colazione
                'dinner' => false,
                'status' => 'departing',
                'treatment' => $customer->treatment
            ];
        }

        // Elaboro camere in arrivo (solo HB per cena, BB non viene mostrato)
        foreach ($arrivingCustomers as $customer) {
            // Salto gli arrivi in BB - non devono essere mostrati
            if ($customer->treatment === 'BB') {
                continue;
            }

            if (isset($roomData[$customer->room])) {
                // Camera che parte e arriva lo stesso giorno
                if ($customer->treatment === 'HB') {
                    $roomData[$customer->room]['dinner'] = true;
                    $roomData[$customer->room]['status'] = 'departing_arriving';
                    $roomData[$customer->room]['arriving_people'] = $customer->number_of_people;
                }
            } else {
                // Solo arrivo HB (gli arrivi BB sono già stati esclusi sopra)
                $roomData[$customer->room] = [
                    'number_of_people' => $customer->number_of_people,
                    'breakfast' => false,
                    'dinner' => true, // Se siamo qui è sicuramente HB
                    'status' => 'arriving',
                    'treatment' => $customer->treatment
                ];
            }
        }

        // Elaboro camere in soggiorno
        foreach ($stayingCustomers as $customer) {
            if (!isset($roomData[$customer->room])) {
                $roomData[$customer->room] = [
                    'number_of_people' => $customer->number_of_people,
                    'breakfast' => true, // Chi soggiorna fa sempre colazione
                    'dinner' => $customer->treatment === 'HB',
                    'status' => 'staying',
                    'treatment' => $customer->treatment
                ];
            }
        }

        // Ordino per numero camera
        ksort($roomData);

        return view('customers.restaurant-print', compact('roomData', 'selectedDate'));
    }
}