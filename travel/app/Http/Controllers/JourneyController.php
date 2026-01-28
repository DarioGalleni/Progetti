<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJourneyRequest;
use App\Http\Requests\UpdateJourneyRequest;
use App\Models\Journey;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * Mostra la tabella di amministrazione interna.
     */
    public function listTable()
    {
        $journeys = Journey::all();
        return view('journeys.table', compact('journeys'));
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
    public function store(StoreJourneyRequest $request)
    {
        // I dati sono già validati grazie alla Form Request

        // Upload Immagini
        $slug = Str::slug($request->title);
        $folder = "journeys/{$slug}";
        $uploadedPaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $file->getClientOriginalExtension();
                $fullFilename = $filename . '-' . uniqid() . '.' . $extension;

                $path = $file->storeAs($folder, $fullFilename, 'r2');
                $uploadedPaths[] = $path;
            }
        }

        // Gestione Copertina
        $coverIndex = $request->input('cover_image_index', 0);
        if (!isset($uploadedPaths[$coverIndex])) {
            $coverIndex = 0;
        }

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('r2');
        $coverUrl = $disk->url($uploadedPaths[$coverIndex]);

        // Pulizia Array Dati
        $includes = array_filter($request->input('includes', []), fn($value) => !is_null($value) && $value !== '');
        $excludes = array_filter($request->input('excludes', []), fn($value) => !is_null($value) && $value !== '');

        // Creazione Record
        $journey = Journey::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'image' => $coverUrl,
            'includes' => array_values($includes),
            'excludes' => array_values($excludes),
            'itinerary' => $request->input('itinerary', []),
        ]);

        // Associazione Immagini
        foreach ($uploadedPaths as $path) {
            \App\Models\JourneyImage::create([
                'journey_id' => $journey->id,
                'path' => $path,
            ]);
        }

        return redirect()->route('journeys.index')->with('success', 'Viaggio creato con successo!');
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
    public function update(UpdateJourneyRequest $request, Journey $journey)
    {
        // I dati sono già validati

        $data = $request->except(['images', 'cover_image_index']);

        // Gestione Nuovi Upload
        if ($request->hasFile('images')) {
            $slug = Str::slug($request->title);
            $folder = "journeys/{$slug}";
            $uploadedPaths = [];

            foreach ($request->file('images') as $file) {
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $file->getClientOriginalExtension();
                $fullFilename = $filename . '-' . uniqid() . '.' . $extension;

                $path = $file->storeAs($folder, $fullFilename, 'r2');
                $uploadedPaths[] = $path;
            }

            foreach ($uploadedPaths as $path) {
                \App\Models\JourneyImage::create([
                    'journey_id' => $journey->id,
                    'path' => $path,
                ]);
            }

            // Aggiornamento Copertina se Selezionata
            $coverIndex = $request->input('cover_image_index', -1);
            if ($coverIndex >= 0 && isset($uploadedPaths[$coverIndex])) {
                /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
                $disk = Storage::disk('r2');
                $data['image'] = $disk->url($uploadedPaths[$coverIndex]);
            }
        }

        // Pulizia Array Dati
        $includes = array_filter($request->input('includes', []), fn($value) => !is_null($value) && $value !== '');
        $excludes = array_filter($request->input('excludes', []), fn($value) => !is_null($value) && $value !== '');

        $data['includes'] = array_values($includes);
        $data['excludes'] = array_values($excludes);
        $data['itinerary'] = $request->input('itinerary', []);

        $journey->update($data);

        return redirect()->route('journeys.index')->with('success', 'Viaggio modificato con successo!');
    }

    /**
     * Rimuove un viaggio dal database.
     */
    public function destroy(Journey $journey)
    {
        // Pulizia Storage
        foreach ($journey->images as $image) {
            Storage::disk('r2')->delete($image->path);
            $image->delete();
        }

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
