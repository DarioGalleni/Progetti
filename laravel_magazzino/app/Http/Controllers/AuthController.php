<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la Facade Auth
use Illuminate\Validation\ValidationException; // Per gestire gli errori di validazione

class AuthController extends Controller
{
    // Mostra il form di login
    public function showLoginForm()
    {
        return view('auth.login'); // Vogliamo una vista chiamata 'auth/login.blade.php'
    }

    // Gestisce il tentativo di login
    public function login(Request $request)
    {
        // 1. Validazione dei dati di input
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return view('welcome');

        }

        // 3. Fallimento dell'autenticazione
        // Se le credenziali non corrispondono, reindirizza con un errore
        throw ValidationException::withMessages([
            'username' => 'Le credenziali fornite non corrispondono ai nostri record.',
        ]);
    }

    // Gestisce il logout
    public function logout(Request $request)
    {
        Auth::logout(); // Effettua il logout dell'utente

        $request->session()->invalidate(); // Invalida la sessione corrente
        $request->session()->regenerateToken(); // Rigenera il token CSRF per prevenire attacchi

        return redirect('/')->with('success', 'Logout effettuato con successo!'); // Reindirizza alla home page
    }
}