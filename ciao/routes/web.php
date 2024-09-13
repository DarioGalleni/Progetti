<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PublicController;

Route::get('/',[PublicController::class, 'home'])->name('home');
Route::post('guest/store', [GuestController::class, 'store'])->name('guest_store');
