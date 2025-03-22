<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Afficher le formulaire de création d'un utilisateur
    public function create()
    {
        return view('admin.users.create');
    }

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        
    
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);
    
    
        // Créer l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    
    
        // Rediriger avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Afficher les détails d'un utilisateur spécifique
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Afficher le formulaire de modification d'un utilisateur
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur existant
    public function update(Request $request, User $user)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id, // Le nom doit être unique, sauf pour l'utilisateur actuel
            'password' => 'nullable|string|min:8', // Mot de passe facultatif
            'role' => 'required|in:admin,user', // Rôle obligatoire et doit être 'admin' ou 'user'
        ]);

        // Mettre à jour les informations de l'utilisateur
        $user->name = $request->name;
        $user->role = $request->role;

        // Mettre à jour le mot de passe si fourni
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Sauvegarder les modifications
        $user->save();

        // Rediriger avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Supprimer un utilisateur
    public function destroy(User $user)
    {
        // Supprimer l'utilisateur
        $user->delete();

        // Rediriger avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}