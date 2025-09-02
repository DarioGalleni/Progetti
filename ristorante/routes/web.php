<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;


Route::get('/', [Controller::class, 'welcome'])->name('home');

// Rotte per le prenotazioni
Route::resource('reservations', ReservationController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
Route::get('reservations/{reservation}/confirmation', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');

// Modifica prenotazione tramite email
Route::get('modify-reservation/{token}', [ReservationController::class, 'modifyByToken'])->name('reservations.modify');
Route::put('modify-reservation/{token}', [ReservationController::class, 'updateByToken'])->name('reservations.update.token');
Route::delete('modify-reservation/{token}', [ReservationController::class, 'cancelByToken'])->name('reservations.cancel.token');

// Nuove rotte per la ricerca tramite email o telefono
Route::get('reservations/find', [ReservationController::class, 'find'])->name('reservations.find');
Route::post('reservations/search', [ReservationController::class, 'search'])->name('reservations.search');

//! Rotta per servire le immagini del ristorante
Route::get('/restaurant_images/{filename}', function ($filename) {
    // Costruisce il percorso completo dell'immagine, tenendo conto delle sottocartelle
    $path = resource_path('restaurant_images/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return Response::file($path);})->name('restaurant.image')->where('filename', '.*'); // Aggiungi questo per permettere i percorsi con '/'