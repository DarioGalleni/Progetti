<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OmbrelloneController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\TechnologyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ==========================================================================
   HOMEPAGE & OMBRELLONI
   ========================================================================== */
Route::get('/', [OmbrelloneController::class, 'index'])
    ->name('home');

/* ==========================================================================
   GESTIONE PRENOTAZIONI
   ========================================================================== */

// Visualizzazione Lista & Ricerca
Route::get('/prenotazioni', [PrenotazioneController::class, 'index'])
    ->name('prenotazioni.index');

// Funzionalità Speciali (Partenze, Ricevute)
Route::get('/prenotazioni/partenze', [PrenotazioneController::class, 'partenze'])
    ->name('prenotazioni.partenze');

Route::get('/prenotazioni/ricevuta/{prenotazione}', [PrenotazioneController::class, 'stampaRicevuta'])
    ->name('prenotazioni.ricevuta');

// CRUD Prenotazioni
Route::get('/prenotazioni/create', [PrenotazioneController::class, 'create'])
    ->name('prenotazioni.create');

Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])
    ->name('prenotazioni.store');

Route::get('/prenotazioni/{prenotazione}', [PrenotazioneController::class, 'show'])
    ->name('prenotazioni.show');

Route::get('/prenotazioni/{id}/edit', [PrenotazioneController::class, 'edit'])
    ->name('prenotazioni.edit');

Route::put('/prenotazioni/{id}', [PrenotazioneController::class, 'update'])
    ->name('prenotazioni.update');

Route::delete('/prenotazioni/{id}', [PrenotazioneController::class, 'destroy'])
    ->name('prenotazioni.destroy');

/* ==========================================================================
   PAGINE ACCESSORIE & INFO
   ========================================================================== */
Route::get('/technology', [TechnologyController::class, 'index'])
    ->name('technology');
