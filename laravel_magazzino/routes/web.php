<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ItemController;

//! Rotte accessibili solo agli utenti autenticati con il permesso 'access-admin-features'
Route::middleware(['auth', 'can:access-admin-features'])->group(function () {
    Route::get('/index_users', [UsersController::class, 'index'])->name('users.index');         // Elenco di tutti gli utenti
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('usersEdit'); // Mostra il form di modifica utente
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('usersUpdate');  // Aggiorna i dati dell'utente
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('usersDestroy'); // Elimina un utente
});


// Rotta per la pagina di benvenuto
Route::get('/', [Controller::class, 'welcome'])->name('welcome');

// Rotte per l'autenticazione
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rotta per il logout (richiede autenticazione)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rotte per la creazione e salvataggio di nuovi utenti
Route::get('/createUsers', [UsersController::class, 'create'])->name('createUsers');
Route::post('/users', [UsersController::class, 'store'])->name('usersStore');

// Nuova posizione per la rotta usersShow: accessibile a tutti
Route::get('/users/{user}', [UsersController::class, 'show'])->name('usersShow');      // Mostra i dettagli dell'utente

// Rotte per la creazione e salvataggio di articoli - Protette da 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/createItem', [ItemController::class, 'create'])->name('createItem');
    Route::post('/articles_store', [ItemController::class, 'store'])->name('articles.store');
    Route::post('/articles/{item}/toggle-like', [ItemController::class, 'toggleLike'])->name('articles.toggleLike');
});

// Rotte per la visualizzazione di articoli (possono rimanere pubbliche)
Route::get('/articles', [ItemController::class, 'index'])->name('articles.index');
Route::get('/articles/{item}', [ItemController::class, 'show'])->name('articles.show');