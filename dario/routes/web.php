<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create',[GuestController::class, 'create'])->name('create');
Route::post('/create/ok',[GuestController::class, 'create_ok'])->name('create_ok');
Route::get('/users',[GuestController::class, 'index'])->name('index');
Route::get('/guest/{id}', [GuestController::class, 'show'])->name('show');

