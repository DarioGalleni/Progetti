<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Response;

// Rotta per la homepage
Route::get('/', function () {
    // Visualizza la vista 'welcome'
    return view('welcome');
})->name('home');

// Rotta per elencare tutte le destinazioni
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');

// Rotta per mostrare il form di creazione di una nuova destinazione
Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');

// Rotta per salvare una nuova destinazione (gestisce l'invio del form)
Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');




//! Rotta per servire le immagini delle destinazioni dalla cartella resources/destinations_images
Route::get('/destinations_images/{filename}', function ($filename) {
    // Costruisce il percorso completo dell'immagine
    $path = resource_path('destinations_images/' . $filename);
    // Se il file non esiste, restituisce errore 404
    if (!file_exists($path)) {
        abort(404);
    }
    // Restituisce il file immagine come risposta HTTP
    return Response::file($path);
})->name('destination.image');
//! Rotta per servire le immagini delle destinazioni dalla cartella resources/destinations_images

