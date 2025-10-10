<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerExpenseController;
use App\Models\Customer;



// Rotta per la home, ora gestita dal CustomerController
Route::get('/', [Controller::class, 'welcome'])->name('welcome'); 

// Rotte per il form e il salvataggio dei dati
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

// Sposta questa rotta sopra quella dinamica per la visualizzazione.
Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');

// Rotta per la dashboard ristorante (deve essere prima delle rotte dinamiche)
Route::get('/customers/restaurant', [RoomController::class, 'restaurant'])->name('customers.restaurant');

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

// Route per aprire la pagina HTML con tutti i dati del cliente
Route::get('/customers/{id}/print-html', function ($id) {
    // Carica cliente con eventuali spese relazionate
    $customer = Customer::with('expenses')->findOrFail($id);

    // Calcoli essenziali (adatta se la logica è diversa nella tua app)
    $additionalExpenses = $customer->expenses->sum('amount');
    // Prova a leggere un campo city_tax sul modello, altrimenti 0
    $cityTax = $customer->city_tax ?? 0;
    $grandTotal = ($customer->total_stay_cost ?? 0) + ($cityTax ?? 0) + ($additionalExpenses ?? 0);
    $finalBalance = $grandTotal - ($customer->down_payment ?? 0);

    return view('customers.bill_html', compact('customer', 'cityTax', 'additionalExpenses', 'grandTotal', 'finalBalance'));
})->name('customers.print_html');

