<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::all();
        return view('destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination' => 'required|string|max:255',
            'duration'    => 'required|integer|min:1',
            'details'     => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image_path'  => 'nullable|image|max:2048',
        ]);

        $data = [
            'destination' => $validated['destination'],
            'duration'    => $validated['duration'],
            'details'     => $validated['details'] ?? null,
            'price'       => $validated['price'],
        ];

        // Gestione upload immagine: salvo il path in image_path
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('', $filename, 'images');
            $data['image_path'] = $filename;
        }

        Destination::create($data);

        return redirect()->route('destinations.index')->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        //
    }
}

