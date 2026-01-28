<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OmbrelloneController;
use App\Http\Controllers\PrenotazioneController;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::get('/login/guest', function () {
    $user = User::firstOrCreate(
        ['email' => 'guest@beach.com'],
        [
            'name' => 'Ospite Demo',
            'password' => Hash::make(Str::random(16)), // Password casuale, tanto usiamo login automatico
        ]
    );

    Auth::login($user);

    return redirect()->route('home');
})->name('login.guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [OmbrelloneController::class, 'index'])->name('home');
    Route::get('/prenotazioni', [PrenotazioneController::class, 'index'])->name('prenotazioni.index');
    Route::get('/prenotazioni/create', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
    Route::get('/prenotazioni/{id}/edit', [PrenotazioneController::class, 'edit'])->name('prenotazioni.edit');
    Route::put('/prenotazioni/{id}', [PrenotazioneController::class, 'update'])->name('prenotazioni.update');
    Route::delete('/prenotazioni/{id}', [PrenotazioneController::class, 'destroy'])->name('prenotazioni.destroy');
    Route::get('/prenotazioni/{prenotazione}', [App\Http\Controllers\PrenotazioneController::class, 'show'])->name('prenotazioni.show');
    Route::get('/technology', [App\Http\Controllers\TechnologyController::class, 'index'])->name('technology');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'store'])
    ->middleware('guest');

