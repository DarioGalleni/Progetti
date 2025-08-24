<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerExpenseController;



// Rotta per la home, ora gestita dal CustomerController
Route::get('/', [Controller::class, 'welcome'])->name('welcome'); 

// Rotte per il form e il salvataggio dei dati
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

// Sposta questa rotta sopra quella dinamica per la visualizzazione.
Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');

// Rotta per visualizzare i dettagli di una prenotazione.
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');

// Rotta per visualizzare il form di modifica
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

// Rotta per aggiornare i dati di una prenotazione
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');

// Rotta per eliminare una prenotazione
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

// Rotte per il controller RoomController
Route::get('/rooms/today-departures', [RoomController::class, 'todayDepartures'])->name('rooms.todayDepartures');

// Rotta per visualizzare il form di aggiornamento delle spese
Route::get('/customers/{customer}/expenses', [CustomerExpenseController::class, 'showUpdateExpenses'])->name('customers.showUpdateExpenses');

// Rotta per salvare le spese
Route::post('/customers/{customer}/expenses', [CustomerExpenseController::class, 'updateExpenses'])->name('customers.updateExpenses');

// Rotta per la pagina di gestione dei conti
Route::get('/today-departures-billing', [App\Http\Controllers\CustomerController::class, 'showTodayDeparturesBilling'])->name('customers.todayDeparturesBilling');

// Rotta per visualizzare il conto dettagliato di un ospite
Route::get('/customers/{customer}/bill', [CustomerController::class, 'showBill'])->name('customers.showBill');

// Route per svuotare cache e file ottimizzati (collegata al pulsante in navbar)
Route::post('/optimize-clear', [App\Http\Controllers\Controller::class, 'optimizeClear'])->name('optimize.clear');

