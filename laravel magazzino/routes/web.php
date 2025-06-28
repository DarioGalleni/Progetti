<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotta per mostrare il form di login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rotta per mostrare il form di registrazione
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

// Rotta per gestire la sottomissione del form di login
Route::post('/login', [LoginController::class, 'login']);

// Rotta per gestire la sottomissione del form di registrazione
Route::post('/register', [RegisterController::class, 'register']); // Aggiunta la rotta POST per la registrazione

// Rotta per il logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Rotta protetta (richiede autenticazione)
Route::middleware(['auth'])->group(function () {
    Route::get('/index', function () {
        return view('index'); // Supponendo che tu abbia una vista 'index.blade.php'
    })->name('index');
});

// Rotta per la home page
Route::get('/', function () {
    return view('welcome');
});