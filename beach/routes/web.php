<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OmbrelloneController;
use App\Http\Controllers\PrenotazioneController;


Route::middleware(['auth'])->group(function () {
//! spostare tutto il blocco dentro per far funzionare login
});    Route::get('/', [OmbrelloneController::class, 'index'])->name('home');
    Route::get('/prenotazioni', [PrenotazioneController::class, 'index'])->name('prenotazioni.index');
    Route::get('/prenotazioni/create', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
    Route::get('/prenotazioni/{id}/edit', [PrenotazioneController::class, 'edit'])->name('prenotazioni.edit');
    Route::put('/prenotazioni/{id}', [PrenotazioneController::class, 'update'])->name('prenotazioni.update');
    Route::delete('/prenotazioni/{id}', [PrenotazioneController::class, 'destroy'])->name('prenotazioni.destroy'); 
    Route::get('/register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'store']);
    Route::get('/prenotazioni/{prenotazione}', [App\Http\Controllers\PrenotazioneController::class, 'show'])->name('prenotazioni.show');

