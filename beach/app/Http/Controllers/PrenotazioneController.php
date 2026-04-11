<?php

namespace App\Http\Controllers;

use App\Models\Ombrellone;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PrenotazioneController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sortBy = $request->get('sort', 'ombrellone');
        $sortDirection = $request->get('direction', 'asc');

        $query = Prenotazione::with('ombrellone');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'LIKE', "%$search%")
                    ->orWhere('cognome', 'LIKE', "%$search%")
                    ->orWhere('telefono', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        if ($sortBy === 'ombrellone') {
            $query->join('ombrelloni', 'prenotazioni.ombrellone_id', '=', 'ombrelloni.id')
                ->orderBy('ombrelloni.fila', $sortDirection)
                ->orderBy('ombrelloni.numero', $sortDirection)
                ->select('prenotazioni.*');
        } elseif ($sortBy === 'arrivo') {
            $query->orderBy('data_inizio', $sortDirection);
        } elseif ($sortBy === 'partenza') {
            $query->orderBy('data_fine', $sortDirection);
        } else {
            $query->orderBy('data_inizio', 'desc');
        }

        $prenotazioni = $query->get();

        return view('prenotazioni.index', compact('prenotazioni', 'search', 'sortBy', 'sortDirection'));
    }

    public function create(Request $request)
    {
        $ombrelloneId = $request->input('ombrellone_id');
        $dataInizio = $request->input('arrivo', now()->format('Y-m-d'));

        $ombrellone = $ombrelloneId ? Ombrellone::find($ombrelloneId) : null;

        if ($ombrelloneId && !$ombrellone) {
            return redirect()->route('home')->with('error', 'Ombrellone non trovato.');
        }

        $ombrelloni = Ombrellone::orderBy('fila')->orderBy('numero')->get();

        return view('prenotazioni.create', compact('ombrellone', 'ombrelloni', 'dataInizio'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ombrellone_id' => 'required|exists:ombrelloni,id',
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'arrivo' => 'required|date|after_or_equal:today',
            'partenza' => 'required|date|after:arrivo',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'note' => 'nullable|string',
            'costo_totale' => 'nullable|numeric|min:0',
            'acconto' => 'nullable|numeric|min:0',
        ]);

        $dataFine = Carbon::parse($validated['partenza'])->subDay()->toDateString();

        $conflitto = Prenotazione::where('ombrellone_id', $validated['ombrellone_id'])
            ->where(function ($q) use ($validated, $dataFine) {
                $q->whereBetween('data_inizio', [$validated['arrivo'], $dataFine])
                    ->orWhereBetween('data_fine', [$validated['arrivo'], $dataFine])
                    ->orWhere(function ($q2) use ($validated, $dataFine) {
                        $q2->where('data_inizio', '<', $validated['arrivo'])
                            ->where('data_fine', '>', $dataFine);
                    });
            })->exists();

        if ($conflitto) {
            return back()->withInput()->with('error', 'Ombrellone già prenotato per questo periodo.');
        }

        Prenotazione::create([
            'ombrellone_id' => $validated['ombrellone_id'],
            'nome' => $validated['nome'],
            'cognome' => $validated['cognome'],
            'data_inizio' => $validated['arrivo'],
            'data_fine' => $dataFine,
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'note' => $validated['note'],
            'costo_totale' => $validated['costo_totale'],
            'acconto' => $validated['acconto'],
        ]);

        return redirect()->route('prenotazioni.create')
            ->with('success', "Prenotazione per {$validated['nome']} {$validated['cognome']} effettuata!");
    }

    public function show($id)
    {
        $prenotazione = Prenotazione::with('ombrellone')->findOrFail($id);
        $dataPartenzaUser = Carbon::parse($prenotazione->data_fine)->addDay();
        $durata = Carbon::parse($prenotazione->data_inizio)->diffInDays($dataPartenzaUser);

        return view('prenotazioni.show', compact('prenotazione', 'dataPartenzaUser', 'durata'));
    }

    public function edit($id)
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $ombrelloni = Ombrellone::orderBy('fila')->orderBy('numero')->get();
        $dataPartenza = Carbon::parse($prenotazione->data_fine)->addDay()->toDateString();
        $dataInizio = $prenotazione->data_inizio;

        return view('prenotazioni.edit', compact('prenotazione', 'ombrelloni', 'dataPartenza', 'dataInizio'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ombrellone_id' => 'required|exists:ombrelloni,id',
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'arrivo' => 'required|date',
            'partenza' => 'required|date|after:arrivo',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'note' => 'nullable|string',
            'costo_totale' => 'nullable|numeric|min:0',
            'acconto' => 'nullable|numeric|min:0',
        ]);

        $dataFine = Carbon::parse($validated['partenza'])->subDay()->toDateString();
        $prenotazione = Prenotazione::findOrFail($id);

        $conflitto = Prenotazione::where('ombrellone_id', $validated['ombrellone_id'])
            ->where('id', '!=', $id)
            ->where(function ($q) use ($validated, $dataFine) {
                $q->whereBetween('data_inizio', [$validated['arrivo'], $dataFine])
                    ->orWhereBetween('data_fine', [$validated['arrivo'], $dataFine])
                    ->orWhere(function ($q2) use ($validated, $dataFine) {
                        $q2->where('data_inizio', '<', $validated['arrivo'])
                            ->where('data_fine', '>', $dataFine);
                    });
            })->exists();

        if ($conflitto) {
            return back()->withInput()->with('error', 'Ombrellone già prenotato per questo periodo.');
        }

        $prenotazione->update([
            'ombrellone_id' => $validated['ombrellone_id'],
            'nome' => $validated['nome'],
            'cognome' => $validated['cognome'],
            'data_inizio' => $validated['arrivo'],
            'data_fine' => $dataFine,
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'note' => $validated['note'],
            'costo_totale' => $validated['costo_totale'],
            'acconto' => $validated['acconto'],
        ]);

        return back()->with('success', 'Prenotazione aggiornata con successo!');
    }

    public function destroy($id)
    {
        Prenotazione::findOrFail($id)->delete();
        return redirect()->route('home')->with('success', 'Prenotazione eliminata!');
    }

    public function partenze(Request $request)
    {
        $date = $request->get('date') ? Carbon::parse($request->get('date')) : Carbon::today();
        $yesterday = $date->copy()->subDay();

        $prenotazioni = Prenotazione::whereDate('data_fine', $yesterday)
            ->join('ombrelloni', 'prenotazioni.ombrellone_id', '=', 'ombrelloni.id')
            ->orderBy('ombrelloni.fila')
            ->orderBy('ombrelloni.numero')
            ->select('prenotazioni.*')
            ->with('ombrellone')
            ->get();

        return view('prenotazioni.partenze', compact('prenotazioni', 'date'));
    }

    public function stampaRicevuta($id)
    {
        $prenotazione = Prenotazione::with('ombrellone')->findOrFail($id);
        $codiceRicevuta = strtoupper(Str::random(8));

        $costoTotale = $prenotazione->costo_totale ?? 0;
        $imponibile = $costoTotale / 1.22;
        $iva = $costoTotale - $imponibile;

        return view('prenotazioni.ricevuta', compact('prenotazione', 'codiceRicevuta', 'imponibile', 'iva'));
    }
}