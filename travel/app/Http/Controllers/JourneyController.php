<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Illuminate\Http\Request;

class JourneyController extends Controller
{
    /**
     * Mostra la lista di tutti i viaggi.
     */
    public function index()
    {
        $journeys = Journey::all();
        return view('journeys.index', compact('journeys'));
    }

    /**
     * Mostra il form per creare un nuovo viaggio.
     */
    public function create()
    {
        return view('journeys.create');
    }

    /**
     * Salva un nuovo viaggio nel database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5000',
        ]);

        // Crea lo slug per la cartella
        $slug = \Illuminate\Support\Str::slug($request->title);
        $folder = "journeys/{$slug}";

        $uploadedPaths = [];

        // Caricamento immagini su S3
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // store() genera un nome unico e salva nel path specificato
                $path = $file->store($folder, 's3');
                $uploadedPaths[] = $path;
            }
        }

        // Usa la prima immagine come copertina (URL completo per compatibilità)
        $coverUrl = \Illuminate\Support\Facades\Storage::disk('s3')->url($uploadedPaths[0]);

        $journey = Journey::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'image' => $coverUrl,
        ]);

        // Salva tutte le immagini nella tabella correlata
        foreach ($uploadedPaths as $path) {
            \App\Models\JourneyImage::create([
                'journey_id' => $journey->id,
                'path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Viaggio creato con successo! Ora puoi inserirne un altro.');
    }

    /**
     * Mostra i dettagli di un singolo viaggio.
     */
    public function show(Journey $journey)
    {
        return view('journeys.show', compact('journey'));
    }

    /**
     * Mostra il form per modificare un viaggio esistente.
     */
    public function edit(Journey $journey)
    {
        return view('journeys.edit', compact('journey'));
    }

    /**
     * Aggiorna un viaggio nel database.
     */
    public function update(Request $request, Journey $journey)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'image' => 'required|url',
        ]);

        $journey->update($validated);

        return redirect()->route('journeys.index')->with('success', 'Viaggio aggiornato con successo!');
    }

    /**
     * Rimuove un viaggio dal database.
     */
    public function destroy(Journey $journey)
    {
        $journey->delete();

        return redirect()->route('journeys.index')->with('success', 'Viaggio eliminato con successo!');
    }
    /**
     * Mostra la galleria fotografica del viaggio.
     */
    public function gallery(Journey $journey)
    {
        return view('journeys.gallery', compact('journey'));
    }
}
