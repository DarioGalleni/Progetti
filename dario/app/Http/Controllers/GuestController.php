<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function welcome()
    {
        return view ('welcome');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $guests = Guest::orderBy('created_at', 'desc')->get();
        return view('index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $genres = Genre::all();
        return view ('create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
               
    //     $guest = Guest::create([
    //         'name' => $request->name,
    //         'surname' => $request->surname,
    //         'placebirth' => $request->placebirth,
    //         'birthdate' => $request->birthdate,
    //         'genre_id' => $request->genre_id,
    //         'img' => $request->file('img')->store('img', 'public'),

    //     ]);
        
    //     return redirect()->route('create')->with('message', 'Utente Inserito');
        

    // }
    public function store(Request $request)
{
    // Ottiengo il nome originale del file
    $imageName = $request->file('img')->getClientOriginalName();

    // Sposta il file nella cartella public/img
    $request->file('img')->move(public_path('img'), $imageName);

    // Salva i dati nel database, includendo SOLO il nome dell'immagine
    $guest = Guest::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'placebirth' => $request->placebirth,
        'birthdate' => $request->birthdate,
        'genre_id' => $request->genre_id,
        'img' => $imageName, // Salva solo il nome del file
    ]);
    
    return redirect()->route('create')->with('message', 'Utente Inserito');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        
        $guests = Guest::findOrFail($id);
        


        return view('show', compact('guests'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
{
    $query = $request->input('query');  // Ottieni il valore dell'input
    $message = null;  // Inizializza il messaggio come nullo
    $guests = collect(); // Inizializza la variabile come collection vuota

    if ($request->has('query')) {
        if ($query) {
            // Cerca i nomi corrispondenti alla query
            $guests = Guest::where('name', 'like', '%' . $query . '%')->get();

            // Se non ci sono risultati, imposta un messaggio
            if ($guests->isEmpty()) {
                $message = "Nessun risultato trovato.";
            }
        } else {
            // Imposta il messaggio se non è stata inserita una query
            $message = "Nessuna query inserita.";
        }
    }

    return view('search', compact('guests', 'message'));  // Ritorna la vista con i risultati
}


}
