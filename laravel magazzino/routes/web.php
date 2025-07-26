<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'welcome'])->name('welcome');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Registration routes
Route::post('/login', [AuthController::class, 'login']);
//logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rotte per la creazione e l'archiviazione di nuovi utenti, accessibili anche senza autenticazione
Route::get('/createUsers', [UsersController::class, 'create'])->name('createUsers');
Route::post('/users', [UsersController::class, 'store'])->name('usersStore');


// Routes accessible only by authenticated users with 'access-admin-features'
Route::middleware(['auth', 'can:access-admin-features'])->group(function () {
    Route::get('/allUsers', [UsersController::class, 'index'])->name('allUsers');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('usersEdit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('usersUpdate');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('usersShow');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('usersDestroy');

});