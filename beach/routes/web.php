<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OmbrelloneController;
use App\Http\Controllers\PrenotazioneController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [OmbrelloneController::class, 'index'])->name('home');
Route::get('/prenotazioni/create', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
Route::get('/prenotazioni', [PrenotazioneController::class, 'index'])->name('prenotazioni.index');
Route::delete('/prenotazioni/{id}', [PrenotazioneController::class, 'destroy'])->name('prenotazioni.destroy');  
Route::get('/prenotazioni/{id}/edit', [PrenotazioneController::class, 'edit'])->name('prenotazioni.edit');
Route::put('/prenotazioni/{id}', [PrenotazioneController::class, 'update'])->name('prenotazioni.update');
