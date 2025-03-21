<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FormulaireController;

// Page de connexion
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Déconnexion
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route pour le formulaire de calcul (accessible à tous les utilisateurs authentifiés)
    Route::get('/formulaire', [FormulaireController::class, 'index'])->name('formulaire');
    Route::post('/formulaire/calculer', [FormulaireController::class, 'calculer'])->name('formulaire.calculer');
    Route::get('/formulaire/export', [FormulaireController::class, 'export'])->name('formulaire.export');

    // Routes pour la gestion des utilisateurs (réservées à l'administrateur)
    Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
        // Tableau de bord administrateur
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Gestion des utilisateurs
        Route::resource('users', UserController::class);
    });
});