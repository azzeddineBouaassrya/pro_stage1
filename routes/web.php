<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FormulaireController;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

// Page de connexion
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

/*
|--------------------------------------------------------------------------
| Routes protégées par authentification
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Déconnexion
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Formulaire de calcul (accessible à tous les utilisateurs authentifiés)
    |--------------------------------------------------------------------------
    */
    Route::prefix('formulaire')->group(function () {
        Route::get('/', [FormulaireController::class, 'index'])->name('formulaire');
        Route::post('/calculer', [FormulaireController::class, 'calculer'])->name('formulaire.calculer');
        Route::get('/export', [FormulaireController::class, 'export'])->name('resulta.export');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes réservées à l'administrateur
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Tableau de bord administrateur
        Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

        // Gestion des utilisateurs
        Route::resource('users', UserController::class);
    });
});