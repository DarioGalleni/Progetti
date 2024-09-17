<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $guests = Guest::all();
        return view('index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_ok(Request $request)
    {
        $guest = Guest::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'placebirth' => $request->placebirth,
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
