<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'welcome'])->name('home');

Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/reservation/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('reservation.confirmation');