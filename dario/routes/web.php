<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

Route::get('/',[GuestController::class, 'welcome'])->name('welcome');
Route::get('/create',[GuestController::class, 'create'])->name('create');
Route::post('/create/ok',[GuestController::class, 'store'])->name('create_ok');
Route::get('/users',[GuestController::class, 'index'])->name('index');
Route::get('/guest/{id}', [GuestController::class, 'show'])->name('show');
Route::get('/search', [GuestController::class, 'search'])->name('search');



