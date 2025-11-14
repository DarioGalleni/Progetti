<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OmbrelloneController;
use App\Http\Controllers\PrenotazioneController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [OmbrelloneController::class, 'index'])->name('home');
// NESSUNA rotta 'load.more.dates'

Route::get('/prenotazioni/create', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
Route::get('/prenotazioni', [PrenotazioneController::class, 'index'])->name('prenotazioni.index');