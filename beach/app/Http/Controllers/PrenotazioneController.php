<?php

namespace App\Http\Controllers;

use App\Models\Ombrellone;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PrenotazioneController extends Controller
{
    /**
     * Mostra l'elenco di tutte le prenotazioni.
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort', 'ombrellone');
        $sortDirection = $request->get('direction', 'asc');

        $query = Prenotazione::with('ombrellone');

        if ($sortBy === 'ombrellone') {
            $query->join('ombrelloni', 'prenotazioni.ombrellone_id', '=', 'ombrelloni.id')
                  ->orderBy('ombrelloni.fila', $sortDirection)
                  ->orderBy('ombrelloni.numero', $sortDirection)
                  ->select('prenotazioni.*');
        } elseif ($sortBy === 'arrivo') {
            $query->orderBy('data_inizio', $sortDirection);
        } elseif ($sortBy === 'partenza') {
            // Si ordina per data_fine che è il giorno prima della partenza
            $query->orderBy('data_fine', $sortDirection);
        } else {
            $query->orderBy('data_inizio', 'desc');
        }

        $prenotazioni = $query->get();

        return view('prenotazioni.index', compact('prenotazioni', 'sortBy', 'sortDirection'));
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

        // LOGICA CHIAVE: L'ultima occupazione (data_fine) è il giorno prima della Data Partenza.
        $dataFineEffettiva = Carbon::parse($validatedData['partenza'])->subDay()->toDateString();

        // 1. Controllo di sovrapposizione
        $conflitto = Prenotazione::where('ombrellone_id', $validatedData['ombrellone_id'])
            ->where(function ($query) use ($validatedData, $dataFineEffettiva) {
                // Controllo se un periodo esistente si sovrappone al nuovo periodo calcolato [Arrivo, Data Fine Effettiva]
                $query->whereBetween('data_inizio', [$validatedData['arrivo'], $dataFineEffettiva])
                    ->orWhereBetween('data_fine', [$validatedData['arrivo'], $dataFineEffettiva])
                    ->orWhere(function ($query) use ($validatedData, $dataFineEffettiva) {
                        $query->where('data_inizio', '<', $validatedData['arrivo'])
                              ->where('data_fine', '>', $dataFineEffettiva);
                    });
            })
            ->exists();

        if ($conflitto) {
            return redirect()->back()->withInput()->with('error', 'L\'ombrellone è già prenotato per una parte o per tutto il periodo selezionato (dal giorno di arrivo fino al giorno prima della partenza).');
        }

        // 2. Creazione del record
        Prenotazione::create([
            'ombrellone_id' => $validatedData['ombrellone_id'],
            'nome' => $validatedData['nome'],
            'cognome' => $validatedData['cognome'],
            'data_inizio' => $validatedData['arrivo'],
            'data_fine' => $dataFineEffettiva,
            'email' => $validatedData['email'] ?? null,
            'telefono' => $validatedData['telefono'] ?? null,
            'note' => $validatedData['note'] ?? null,
            'costo_totale' => $validatedData['costo_totale'] ?? null,
            'acconto' => $validatedData['acconto'] ?? null,
        ]);

        return redirect()->route('prenotazioni.index')->with('success', 'Prenotazione effettuata con successo.');
    }

    /**
     * Elimina la prenotazione specifica dal database.
     */
    public function destroy($id)
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $prenotazione->delete();

        return redirect()->route('prenotazioni.index')->with('success', 'Prenotazione eliminata con successo.');
    }

    /**
     * Mostra il form per la modifica di una prenotazione.
     */
    public function edit($id)
{
    $prenotazione = Prenotazione::findOrFail($id);
    $ombrelloni = Ombrellone::orderBy('fila')->orderBy('numero')->get();

    // LOGICA CHIAVE: Calcola la data di Partenza per il form (data_fine + 1 giorno)
    $dataPartenza = Carbon::parse($prenotazione->data_fine)->addDay()->toDateString();
    
    // Aggiungi la definizione per la Data Arrivo (data_inizio)
    // Usa l'accessor 'arrivo' definito nel modello per maggiore chiarezza
    $dataInizio = $prenotazione->arrivo; 

    return view('prenotazioni.edit', compact('prenotazione', 'ombrelloni', 'dataPartenza', 'dataInizio'));
}

    /**
     * Aggiorna la prenotazione specifica nel database.
     */
    public function update(Request $request, $id)
    {
        // 1. Validazione dei dati
        $validatedData = $request->validate([
            'ombrellone_id' => 'required|exists:ombrelloni,id',
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'arrivo' => 'required|date|after_or_equal:today',       // Data di inizio occupazione
            'partenza' => 'required|date|after:arrivo',             // Giorno di rilascio ombrellone
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'note' => 'nullable|string',
            'costo_totale' => 'nullable|numeric|min:0',
            'acconto' => 'nullable|numeric|min:0',
        ]);

        // LOGICA CHIAVE: Calcola l'ultima occupazione (data_fine) come il giorno prima della Partenza.
        $dataFineEffettiva = Carbon::parse($validatedData['partenza'])->subDay()->toDateString();

        // 2. Trova la prenotazione esistente
        $prenotazione = Prenotazione::findOrFail($id);

        // 3. Controllo di sovrapposizione (escludendo la prenotazione corrente)
        $conflitto = Prenotazione::where('ombrellone_id', $validatedData['ombrellone_id'])
            // Esclude la prenotazione che stiamo modificando dal controllo
            ->where('id', '!=', $id)
            ->where(function ($query) use ($validatedData, $dataFineEffettiva) {
                // Controllo se un periodo esistente si sovrappone al nuovo periodo [Arrivo, Data Fine Effettiva]
                $query->whereBetween('data_inizio', [$validatedData['arrivo'], $dataFineEffettiva])
                      ->orWhereBetween('data_fine', [$validatedData['arrivo'], $dataFineEffettiva])
                      ->orWhere(function ($query) use ($validatedData, $dataFineEffettiva) {
                          $query->where('data_inizio', '<', $validatedData['arrivo'])
                                ->where('data_fine', '>', $dataFineEffettiva);
                      });
            })
            ->exists();

        if ($conflitto) {
            return redirect()->back()->withInput()->with('error', 'L\'ombrellone è già prenotato per una parte o per tutto il periodo selezionato (dal giorno di arrivo fino al giorno prima della partenza).');
        }

        // 4. Aggiorna gli attributi con i dati corretti
        $prenotazione->update([
            'ombrellone_id' => $validatedData['ombrellone_id'],
            'nome' => $validatedData['nome'],
            'cognome' => $validatedData['cognome'],
            'data_inizio' => $validatedData['arrivo'],      // Usa l'input 'arrivo'
            'data_fine' => $dataFineEffettiva,             // Usa la data calcolata
            'email' => $validatedData['email'] ?? null,
            'telefono' => $validatedData['telefono'] ?? null,
            'note' => $validatedData['note'] ?? null,
            'costo_totale' => $validatedData['costo_totale'] ?? null,
            'acconto' => $validatedData['acconto'] ?? null,
        ]);

        // 5. Reindirizza con messaggio di successo
        return redirect()->route('prenotazioni.index')->with('success', 'Prenotazione aggiornata con successo!');
    }
}