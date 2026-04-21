<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/toggle', [DashboardController::class, 'toggleReservations'])->name('dashboard.toggle');

Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/search', [ReservationController::class, 'search'])->name('reservations.search');
Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
