<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Assicurati che sia importato

class LoginController extends Controller
{
    /**
     * Mostra il form di login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Gestisce la richiesta di login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        // QUESTA È LA RIGA CORRETTA E SICURA:
        if ($user && Hash::check($password, $user->password)) { // Usa Hash::check() per le password hashate
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->intended('/index');
        }

        return back()->withErrors([
            'username' => 'Nome utente o password non validi.',
        ])->onlyInput('username');
    }

    /**
     * Effettua il logout dell'utente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
