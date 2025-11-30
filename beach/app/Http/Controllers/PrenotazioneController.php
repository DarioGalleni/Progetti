<?php

namespace App\Http\Controllers;

use App\Models\Ombrellone;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PrenotazioneController extends Controller
{
    /**
     * Mostra l'elenco di tutte le prenotazioni con filtri e ordinamento.
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort', 'ombrellone');
        $sortDirection = $request->get('direction', 'asc');
        $search = $request->get('search');

        $query = Prenotazione::with('ombrellone');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'LIKE', '%' . $search . '%')
                  ->orWhere('cognome', 'LIKE', '%' . $search . '%')
                  ->orWhere('telefono', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
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

        return view('prenotazioni.index', compact('prenotazioni', 'sortBy', 'sortDirection', 'search'));
    }

    /**
     * Mostra il form per la creazione di una nuova prenotazione.
     */
    public function create(Request $request)
    {
        $ombrelloneId = $request->input('ombrellone_id');
        $dataInizio = $request->input('arrivo', now()->format('Y-m-d'));

        $ombrellone = null;
        if ($ombrelloneId) {
            $ombrellone = Ombrellone::find($ombrelloneId);
        }

        if (!$ombrellone && $ombrelloneId) {
            return redirect()->route('home')->with('error', 'Ombrellone non trovato.');
        }

        $ombrelloni = Ombrellone::orderBy('fila')->orderBy('numero')->get();

        return view('prenotazioni.create', compact('ombrellone', 'ombrelloni', 'dataInizio'));
    }

    /**
     * Salva una nuova prenotazione nel database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ombrellone_id' => 'required|exists:ombrelloni,id',
            'nome'          => 'required|string|max:255',
            'cognome'       => 'required|string|max:255',
            'arrivo'        => 'required|date|after_or_equal:today',
            'partenza'      => 'required|date|after:arrivo',
            'email'         => 'nullable|email|max:255',
            'telefono'      => 'nullable|string|max:20',
            'note'          => 'nullable|string',
            'costo_totale'  => 'nullable|numeric|min:0',
            'acconto'       => 'nullable|numeric|min:0',
        ]);

        $dataFineEffettiva = Carbon::parse($validatedData['partenza'])->subDay()->toDateString();

        $conflitto = Prenotazione::where('ombrellone_id', $validatedData['ombrellone_id'])
            ->where(function ($query) use ($validatedData, $dataFineEffettiva) {
                $query->whereBetween('data_inizio', [$validatedData['arrivo'], $dataFineEffettiva])
                      ->orWhereBetween('data_fine', [$validatedData['arrivo'], $dataFineEffettiva])
                      ->orWhere(function ($query) use ($validatedData, $dataFineEffettiva) {
                          $query->where('data_inizio', '<', $validatedData['arrivo'])
                                ->where('data_fine', '>', $dataFineEffettiva);
                      });
            })
            ->exists();

        if ($conflitto) {
            return redirect()->back()->withInput()->with('error', 'L\'ombrellone è già prenotato per il periodo selezionato.');
        }

        Prenotazione::create([
            'ombrellone_id' => $validatedData['ombrellone_id'],
            'nome'          => $validatedData['nome'],
            'cognome'       => $validatedData['cognome'],
            'data_inizio'   => $validatedData['arrivo'],
            'data_fine'     => $dataFineEffettiva,
            'email'         => $validatedData['email'] ?? null,
            'telefono'      => $validatedData['telefono'] ?? null,
            'note'          => $validatedData['note'] ?? null,
            'costo_totale'  => $validatedData['costo_totale'] ?? null,
            'acconto'       => $validatedData['acconto'] ?? null,
        ]);

        return redirect()->route('prenotazioni.create')
            ->with('success', 'Prenotazione per ' . $validatedData['nome'] . ' ' . $validatedData['cognome'] . ' effettuata con successo.');
    }

    /**
     * Mostra i dettagli di una specifica prenotazione.
     */
    public function show($id)
    {
        $prenotazione = Prenotazione::with('ombrellone')->findOrFail($id);

        $dataPartenzaUser = Carbon::parse($prenotazione->data_fine)->addDay();
        $dataInizioUser = Carbon::parse($prenotazione->data_inizio);
        $durata = $dataInizioUser->diffInDays($dataPartenzaUser);

        return view('prenotazioni.show', compact('prenotazione', 'dataPartenzaUser', 'durata'));
    }

    /**
     * Mostra il form per la modifica di una prenotazione.
     */
    public function edit($id)
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $ombrelloni = Ombrellone::orderBy('fila')->orderBy('numero')->get();

        $dataPartenza = Carbon::parse($prenotazione->data_fine)->addDay()->toDateString();
        $dataInizio = $prenotazione->data_inizio;

        return view('prenotazioni.edit', compact('prenotazione', 'ombrelloni', 'dataPartenza', 'dataInizio'));
    }

    /**
     * Aggiorna la prenotazione specifica nel database.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ombrellone_id' => 'required|exists:ombrelloni,id',
            'nome'          => 'required|string|max:255',
            'cognome'       => 'required|string|max:255',
            'arrivo'        => 'required|date|after_or_equal:today',
            'partenza'      => 'required|date|after:arrivo',
            'email'         => 'nullable|email|max:255',
            'telefono'      => 'nullable|string|max:20',
            'note'          => 'nullable|string',
            'costo_totale'  => 'nullable|numeric|min:0',
            'acconto'       => 'nullable|numeric|min:0',
        ]);

        $dataFineEffettiva = Carbon::parse($validatedData['partenza'])->subDay()->toDateString();
        $prenotazione = Prenotazione::findOrFail($id);

        $conflitto = Prenotazione::where('ombrellone_id', $validatedData['ombrellone_id'])
            ->where('id', '!=', $id)
            ->where(function ($query) use ($validatedData, $dataFineEffettiva) {
                $query->whereBetween('data_inizio', [$validatedData['arrivo'], $dataFineEffettiva])
                      ->orWhereBetween('data_fine', [$validatedData['arrivo'], $dataFineEffettiva])
                      ->orWhere(function ($query) use ($validatedData, $dataFineEffettiva) {
                          $query->where('data_inizio', '<', $validatedData['arrivo'])
                                ->where('data_fine', '>', $dataFineEffettiva);
                      });
            })
            ->exists();

        if ($conflitto) {
            return redirect()->back()->withInput()->with('error', 'L\'ombrellone è già prenotato per il periodo selezionato.');
        }

        $prenotazione->update([
            'ombrellone_id' => $validatedData['ombrellone_id'],
            'nome'          => $validatedData['nome'],
            'cognome'       => $validatedData['cognome'],
            'data_inizio'   => $validatedData['arrivo'],
            'data_fine'     => $dataFineEffettiva,
            'email'         => $validatedData['email'] ?? null,
            'telefono'      => $validatedData['telefono'] ?? null,
            'note'          => $validatedData['note'] ?? null,
            'costo_totale'  => $validatedData['costo_totale'] ?? null,
            'acconto'       => $validatedData['acconto'] ?? null,
        ]);

        return redirect()->route('prenotazioni.show', $id)->with('success', 'Prenotazione aggiornata con successo!');
    }

    /**
     * Elimina la prenotazione specifica.
     */
    public function destroy($id)
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $prenotazione->delete();

        return redirect()->route('home')->with('success', 'Prenotazione eliminata con successo.');
    }
}