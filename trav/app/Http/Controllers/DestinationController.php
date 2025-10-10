<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('destinations.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'destination' => 'required|string|max:255|unique:destinations,destination',
            'duration' => 'required|string|max:100',
            'details' => 'required|string',
            'price' => 'required|integer|min:0',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $filename = null;
        if ($request->hasFile('image_path')) {
            $slug = Str::slug($validatedData['destination']);
            $extension = $request->file('image_path')->getClientOriginalExtension();
            // Nome file basato sullo slug per l'immagine di copertina
            $filename = $slug . '.' . $extension;
            // 1. SALVATAGGIO DELL'IMMAGINE DI COPERTINA (root del disco 'public')
            $request->file('image_path')->storeAs('/', $filename, 'public');
            // 2. CREAZIONE DELLA SOTTOCARTELLA E COPIA (per Show)
            $subfolder = $slug;
            // Copia l'immagine di copertina nella sottocartealla per la galleria
            Storage::disk('public')->copy($filename, $subfolder . '/' . $filename);
        }
        Destination::create([
            'destination' => $validatedData['destination'],
            'duration' => $validatedData['duration'],
            'details' => $validatedData['details'],
            'price' => $validatedData['price'],
            'image_path' => $filename,
        ]);
        return redirect()->route('destinations.index')->with('success', 'Destinazione aggiunta con successo!');


    }

    public function show(Destination $destination)
    {
        $slug = Str::slug($destination->destination);
        $images = [];

        // Il path da cercare è la sottocartella dello slug
        if (Storage::disk('public')->exists($slug)) {
            // Recuperiamo tutti i file al suo interno
            $imageFiles = Storage::disk('public')->files($slug);

            foreach ($imageFiles as $filePath) {
                // Prepariamo il percorso web completo
                $images[] = 'media/destinations_images/' . $filePath;
            }
        }

        // Passiamo $images alla vista (anche se vuoto)
        return view('destinations.show', compact('destination', 'images'));
    }
}