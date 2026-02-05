<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CleaningController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\GroupController;

use App\Http\Controllers\DatabaseSyncController;

/* ==================== HOME ==================== */
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

/* ==================== CLIENTI ==================== */
Route::prefix('customers')->name('customers.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('{customer}', [CustomerController::class, 'show'])->name('show');
    Route::get('{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::match(['put', 'patch'], '{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('{customer}', [CustomerController::class, 'destroy'])->name('destroy');
});

/* ==================== GRUPPI ==================== */
Route::prefix('groups')->name('groups.')->group(function () {
    Route::get('/create', [GroupController::class, 'create'])->name('create');
    Route::post('/', [GroupController::class, 'store'])->name('store');
    Route::get('/{groupId}', [GroupController::class, 'show'])->name('show');
    Route::get('/{groupId}/edit', [GroupController::class, 'edit'])->name('edit');
    Route::put('/{groupId}', [GroupController::class, 'update'])->name('update');
    Route::delete('/{groupId}', [GroupController::class, 'destroy'])->name('destroy');
});

/* ==================== FATTURAZIONE ==================== */
Route::prefix('billing')->name('billing.')->group(function () {
    Route::get('{customer}/expenses', [BillingController::class, 'expenses'])->name('expenses');
    Route::post('{customer}/expenses', [BillingController::class, 'storeExpense'])->name('storeExpense');
    Route::post('{customer}/expenses/update', [BillingController::class, 'updateExpenses'])->name('expenses.update');
    Route::get('{customer}/expenses/print', [BillingController::class, 'printExpenses'])->name('expenses.print');
    Route::get('{customer}/bill/print', [BillingController::class, 'printBill'])->name('bill.print');
    Route::get('{customer}/receipt', [BillingController::class, 'receipt'])->name('receipt');
});

/* ==================== MOBILE ==================== */
Route::prefix('mobile')->name('mobile.')->group(function () {
    Route::get('/extras', [BillingController::class, 'mobileExtrasIndex'])->name('extras.index');
    Route::get('/extras/{customer}', [BillingController::class, 'mobileExtrasShow'])->name('extras.show');
});

/* ==================== PULIZIE ==================== */
Route::prefix('cleaning')->name('cleaning.')->group(function () {
    Route::get('/', [CleaningController::class, 'index'])->name('index');
    Route::get('/print', [CleaningController::class, 'print'])->name('print');
});

/* ==================== RISTORANTE ==================== */
Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');

/* ==================== RECEPTION ==================== */
Route::get('/arrivals', [ReceptionController::class, 'arrivals'])->name('arrivals.index');
Route::get('/departures', [ReceptionController::class, 'departures'])->name('departures.index');

/* ==================== SISTEMA ==================== */
Route::post('/system/sync-db', [DatabaseSyncController::class, 'sync'])->name('system.sync-db');

Route::post('/system/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return back()->with('success', 'Tutte le cache di sistema sono state pulite!');
})->name('system.clear-cache');