<?php

namespace App\Http\Controllers;

use App\Models\Ombrellone;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OmbrelloneController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('it');

        $selectedMonth = $request->input('month') ? Carbon::parse($request->input('month')) : Carbon::now();

        $firstDayOfCalendar = $selectedMonth->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);
        $lastDayOfCalendar = $selectedMonth->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $previousMonth = $selectedMonth->copy()->subMonth();
        $nextMonth = $selectedMonth->copy()->addMonth();

        $ombrelloniPerFila = Ombrellone::with([
            'prenotazioni' => function ($query) use ($firstDayOfCalendar, $lastDayOfCalendar) {
                $query->where('data_inizio', '<=', $lastDayOfCalendar)
                    ->where('data_fine', '>=', $firstDayOfCalendar);
            }
        ])->orderBy('fila')->orderBy('numero')->get()->groupBy('fila');

        $availableUmbrellas = collect();
        $isSearch = false;

        if ($request->filled(['arrivo', 'partenza'])) {
            $start = Carbon::parse($request->arrivo);
            $end = Carbon::parse($request->partenza);
            $isSearch = true;

            if ($end->gte($start)) {
                $availableUmbrellas = Ombrellone::whereDoesntHave('prenotazioni', function ($q) use ($start, $end) {
                    $q->where('data_inizio', '<=', $end)
                        ->where('data_fine', '>=', $start);
                })->orderBy('fila')->orderBy('numero')->get()->groupBy('fila');
            }
        }

        return view('welcome', compact(
            'ombrelloniPerFila',
            'selectedMonth',
            'firstDayOfCalendar',
            'lastDayOfCalendar',
            'previousMonth',
            'nextMonth',
            'availableUmbrellas',
            'isSearch'
        ));
    }
}