<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tenter de connecter l'utilisateur
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Rediriger en fonction du rôle
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with('success', 'Connexion réussie en tant qu\'administrateur.');
            } else {
                return redirect()->intended('/formulaire')->with('success', 'Connexion réussie.');
            }
        }

        // Si l'authentification échoue, rediriger avec un message d'erreur
        return back()->withErrors([
            'name' => 'Nom d\'utilisateur ou mot de passe incorrect.',
        ])->withInput($request->only('name'));
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Déconnexion réussie.');
    }
}