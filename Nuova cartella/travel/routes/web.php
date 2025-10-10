<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {return view('welcome');})->name('home');

// Rotte per le operazioni CRUD sulle destinazioni
Route::resource('destinations', DestinationController::class);

//! Rotta per servire le immagini delle destinazioni dalla cartella resources/destinations_images
Route::get('/img/{filename}', function ($filename) {
    // Costruisce il percorso completo dell'immagine
    $path = resource_path('media/destinations_images/' . $filename);
    // Se il file non esiste, restituisce errore 404
    if (!file_exists($path)) {
        abort(404);
    }
    // Restituisce il file immagine come risposta HTTP
    return Response::file($path);
})->name('images');