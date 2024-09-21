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
    public function store(Request $request)
    {
        
        
        $guest = Guest::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'placebirth' => $request->placebirth,
            'birthdate' => $request->birthdate,
            'genre_id' => $request->genre_id,
        ]);
        
        return redirect()->route('create')->with('message', 'Utente Inserito');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        
        $guest = Guest::findOrFail($id);
        return view('show', compact('guest'));
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

    if ($query) {
        // Cerca i nomi corrispondenti alla query
        $guests = Guest::where('name', 'like', '%' . $query . '%')->get();

    } else {
        // Se non c'è una query, non restituire nulla o un array vuoto
        $guests = collect();  // Collezione vuota
    }

    return view('search', compact('guests'));  // Ritorna la vista con i risultati
}

}
