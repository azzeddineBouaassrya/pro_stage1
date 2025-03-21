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
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,user', // Vérifier que le rôle est valide
        ]);

        // Tenter de connecter l'utilisateur
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password, 'role' => $request->role])) {
            $request->session()->regenerate();

            // Rediriger en fonction du rôle
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // Rediriger vers le tableau de bord admin
            } else {
                return redirect()->intended('/formulaire'); // Rediriger vers la page de calcul
            }
        }

        // Si l'authentification échoue, rediriger avec un message d'erreur
        return back()->withErrors([
            'name' => 'Les identifiants sont incorrects.',
        ]);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
