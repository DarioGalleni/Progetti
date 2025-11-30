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

        // Determina il mese selezionato (dal parametro URL 'month') o usa il mese corrente
        $selectedMonth = $request->input('month')
            ? Carbon::parse($request->input('month'))
            : Carbon::now();

        // Calcola il primo giorno da mostrare nel calendario (lunedì della prima settimana del mese)
        $firstDayOfCalendar = $selectedMonth->copy()
            ->startOfMonth()
            ->startOfWeek(Carbon::MONDAY);

        // Calcola l'ultimo giorno da mostrare (domenica dell'ultima settimana del mese)
        $lastDayOfCalendar = $selectedMonth->copy()
            ->endOfMonth()
            ->endOfWeek(Carbon::SUNDAY);

        // Calcola i link per il mese precedente e successivo
        $previousMonth = $selectedMonth->copy()->subMonth();
        $nextMonth = $selectedMonth->copy()->addMonth();

        // Carica gli ombrelloni, raggruppati per fila
        // Eager load solo le prenotazioni rilevanti per l'intervallo di date visualizzato
        $ombrelloniPerFila = Ombrellone::with(['prenotazioni' => function ($query) use ($firstDayOfCalendar, $lastDayOfCalendar) {
            $query->where('data_inizio', '<=', $lastDayOfCalendar)
                    ->where('data_fine', '>=', $firstDayOfCalendar);
        }])
        ->orderBy('fila')
        ->orderBy('numero')
        ->get()
        ->groupBy('fila');

        // Passa tutti i dati necessari alla vista
        return view('welcome', compact(
            'ombrelloniPerFila',
            'selectedMonth',
            'firstDayOfCalendar',
            'lastDayOfCalendar',
            'previousMonth',
            'nextMonth'
        ));
    }
}