<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crea', [ArticlesController::class, 'create'])->name('aggiungi');
Route::post('/crea', [ArticlesController::class, 'store'])->name('aggiungi');


