<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerExpenseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Home / Pagina di Benvenuto
Route::get('/', [CustomerController::class, 'welcome'])->name('welcome');

// Rotte Specifiche Clienti
Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');
Route::get('/customers/departures/today/billing', [CustomerController::class, 'todayDeparturesBilling'])->name('customers.todayDeparturesBilling');
Route::get('/customers/restaurant', [RoomController::class, 'restaurant'])->name('customers.restaurant');
Route::get('/customers/restaurant/print', [RoomController::class, 'printRestaurant'])->name('customers.restaurant.print');

// Rotte Gruppi
Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
Route::get('/groups/{customer}/edit', [GroupController::class, 'edit'])->name('groups.edit');
Route::put('/groups/{customer}', [GroupController::class, 'update'])->name('groups.update');
Route::delete('/groups/{customer}', [GroupController::class, 'destroy'])->name('groups.destroy');

// Risorsa Clienti
Route::resource('customers', CustomerController::class);

// Rotte Camere
Route::get('/rooms/departures/today', [RoomController::class, 'todayDepartures'])->name('rooms.todayDepartures');
Route::get('/rooms/departures/today/print', [RoomController::class, 'printTodayDepartures'])->name('rooms.todayDepartures.print');

// Spese e Fatturazione Clienti
Route::get('/customers/{customer}/bill', [CustomerController::class, 'showBill'])->name('customers.bill');
Route::get('/customers/{customer}/print-bill', [CustomerController::class, 'printBill'])->name('customers.print_bill');
Route::get('/customers/{customer}/print-receipt', [CustomerController::class, 'printReceipt'])->name('customers.print_receipt');
Route::get('/customers/{customer}/expenses', [CustomerExpenseController::class, 'showUpdateExpenses'])->name('customers.expenses.show');
Route::post('/customers/{customer}/expenses', [CustomerExpenseController::class, 'updateExpenses'])->name('customers.expenses.update');

// Rotte di Utilità
Route::post('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return back()->with('success', 'Cache svuotata con successo!');
})->name('optimize.clear');
