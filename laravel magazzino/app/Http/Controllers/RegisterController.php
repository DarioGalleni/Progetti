<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Mostra il form di registrazione.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Valida i dati ricevuti dal form
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Salva il nuovo utente
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Effettua altre operazioni, come l'autenticazione, se necessario
        // Potresti voler autenticare l'utente automaticamente dopo la registrazione
        // Auth::login($user); // Se vuoi autenticare l'utente appena registrato

        return redirect()->route('login')->with('success', 'Registrazione completata con successo! Ora puoi accedere.'); // Reindirizza al login dopo la registrazione
    }
}