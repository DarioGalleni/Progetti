<?php

namespace App\Http\Controllers;

use App\Models\Ombrellone;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Carbon\Carbon; // Assicurati che Carbon sia importato

class PrenotazioneController extends Controller
{
    /**
     * Mostra l'elenco di tutte le prenotazioni.
     */
    public function index(Request $request)
{
    // 1. Parametri di ordinamento
    // 'ombrellone' come ordinamento predefinito
    $sortBy = $request->get('sort', 'ombrellone'); 
    // 'asc' come direzione predefinita
    $sortDirection = $request->get('direction', 'asc'); 

    $query = Prenotazione::with('ombrellone');

    // 2. Logica di ordinamento
    if ($sortBy === 'ombrellone') {
        // Per Ombrellone, uniamo la tabella 'ombrelloni' per ordinare correttamente
        $query->join('ombrelloni', 'prenotazioni.ombrellone_id', '=', 'ombrelloni.id')
              // Ordina per Fila e poi per Numero, usando la direzione richiesta
              ->orderBy('ombrelloni.fila', $sortDirection)
              ->orderBy('ombrelloni.numero', $sortDirection)
              ->select('prenotazioni.*'); // È cruciale riselezionare solo le colonne di 'prenotazioni'
    } elseif ($sortBy === 'arrivo') {
        // Ordina per data_inizio (Arrivo)
        $query->orderBy('data_inizio', $sortDirection);
    } elseif ($sortBy === 'partenza') {
        // Ordina per data_fine (giorno prima della Partenza)
        $query->orderBy('data_fine', $sortDirection); 
    } else {
        // Fallback: ordinamento per Arrivo (data_inizio) in ordine decrescente
        $query->orderBy('data_inizio', 'desc');
    }

    $prenotazioni = $query->get();
            
    // Passiamo i parametri di ordinamento attuali alla vista
    return view('prenotazioni.index', compact('prenotazioni', 'sortBy', 'sortDirection'));
}

    /**
     * Mostra il form per creare una nuova prenotazione.
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

        // Se non viene trovato (o non è specificato), carichiamo tutti gli ombrelloni per la select
        $ombrelloni = Ombrellone::orderBy('fila')->orderBy('numero')->get();


        return view('prenotazioni.create', compact('ombrellone', 'ombrelloni', 'dataInizio'));
    }

    /**
     * Memorizza una nuova prenotazione nel database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ombrellone_id' => 'required|exists:ombrelloni,id',
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'arrivo' => 'required|date|after_or_equal:today', // Validazione per Arrivo
            'partenza' => 'required|date|after:arrivo',       // Validazione per Partenza (deve essere dopo Arrivo)
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'note' => 'nullable|string',
            'costo_totale' => 'nullable|numeric|min:0',
            'acconto' => 'nullable|numeric|min:0',
        ]);

        // LOGICA CHIAVE: L'ultima occupazione (data_fine) è il giorno prima della Partenza.
        $dataFineEffettiva = Carbon::parse($validatedData['partenza'])->subDay()->toDateString();

        // Verifica che l'ombrellone non sia già prenotato nel periodo calcolato
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

        // Creazione della prenotazione con i dati mappati
        Prenotazione::create([
            'ombrellone_id' => $validatedData['ombrellone_id'],
            'nome' => $validatedData['nome'],
            'cognome' => $validatedData['cognome'],
            'data_inizio' => $validatedData['arrivo'],
            'data_fine' => $dataFineEffettiva, // Usiamo la data calcolata
            'email' => $validatedData['email'] ?? null,
            'telefono' => $validatedData['telefono'] ?? null,
            'note' => $validatedData['note'] ?? null,
            'costo_totale' => $validatedData['costo_totale'] ?? null,
            'acconto' => $validatedData['acconto'] ?? null,
        ]);

        return redirect()->route('prenotazioni.index')->with('success', 'Prenotazione effettuata con successo.');
    }
}