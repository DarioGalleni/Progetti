<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ItemController; // Modificato da ItemsModelController a ItemController


//! Rotte accessibili solo agli utenti autenticati con il permesso 'access-admin-features'
Route::middleware(['auth', 'can:access-admin-features'])->group(function () {
    Route::get('/allUsers', [UsersController::class, 'index'])->name('allUsers');         // Elenco di tutti gli utenti
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('usersEdit'); // Mostra il form di modifica utente
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('usersUpdate');  // Aggiorna i dati dell'utente
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('usersShow');      // Mostra i dettagli dell'utente
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('usersDestroy'); // Elimina un utente
});


// Rotta per la pagina di benvenuto
Route::get('/', [Controller::class, 'welcome'])->name('welcome');

// Rotte per l'autenticazione
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rotta per il logout (richiede autenticazione)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rotte per la creazione e salvataggio di nuovi utenti (queste possono rimanere senza auth se vuoi registrazione pubblica)
Route::get('/createUsers', [UsersController::class, 'create'])->name('createUsers');
Route::post('/users', [UsersController::class, 'store'])->name('usersStore');

// Rotte per la creazione e salvataggio di articoli - Protette da 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/createItem', [ItemController::class, 'create'])->name('createItem'); // Modificato il controller
    Route::post('/articles_store', [ItemController::class, 'store'])->name('articles.store'); // Modificato il controller
});

// Rotte per la visualizzazione di articoli (possono rimanere pubbliche)
Route::get('/articles', [ItemController::class, 'index'])->name('articles.index'); // Modificato il controller
Route::get('/articles/{item}', [ItemController::class, 'show'])->name('articles.show'); // Modificato il controller e il parametro della rotta