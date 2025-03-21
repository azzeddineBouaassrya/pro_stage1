<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class FormulaireController extends Controller
{
    public function calculer(Request $request)
    {
        $request->validate([
            'longueur' => 'required|numeric',
            'largeur' => 'required|numeric',
            'nombre_lignes' => 'required|numeric',
            'quantite_produit_g' => 'required|numeric',
            'quantite_produit_cc' => 'required|numeric',
            'quantite_eau_litres_m2' => 'required|numeric',
            'debit_eau_litres_heure' => 'required|numeric',
        ]);

        // Calculs
        $surface = $request->longueur * $request->largeur * $request->nombre_lignes;
        $quantite_totale_litres = ($request->quantite_produit_cc / 1000) * $surface; // Conversion cc en litres
        $quantite_totale_kg = ($request->quantite_produit_g / 1000) * $surface; // Conversion g en kg
        $quantite_eau_totale_litres = $request->quantite_eau_litres_m2 * $surface;
        $debit_eau_litres_minute = $request->debit_eau_litres_heure / 60;
        $periode_application_heures = $quantite_eau_totale_litres / $request->debit_eau_litres_heure;
        $periode_application_minutes = $periode_application_heures * 60;

        // Résultats
        $results = [
            'surface' => $surface,
            'quantite_totale_litres' => $quantite_totale_litres,
            'quantite_totale_kg' => $quantite_totale_kg,
            'quantite_eau_totale_litres' => $quantite_eau_totale_litres,
            'debit_eau_litres_minute' => $debit_eau_litres_minute,
            'periode_application_heures' => $periode_application_heures,
            'periode_application_minutes' => $periode_application_minutes,
        ];

        // Stocker les résultats dans la session
        $request->session()->put('results', $results);

        return view('forme.formulaire', compact('results'));
    }

    public function index()
    {
        return view('forme.formulaire');
    }


    public function export(Request $request)
    {
        // Récupérer les résultats de la session
        $results = $request->session()->get('results');

        // Vérifier si les résultats existent
        if (!$results) {
            return redirect()->route('formulaire')->with('error', 'Aucun résultat à exporter. Veuillez d\'abord effectuer un calcul.');
        }

        // Créer un nouveau document Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText('Résultats du Calcul', ['bold' => true, 'size' => 16]);

        // Ajouter les résultats au document
        $section->addText("Surface : {$results['surface']} m²");
        $section->addText("Quantité totale de produit (litres) : {$results['quantite_totale_litres']}");
        $section->addText("Quantité totale de produit (kg) : {$results['quantite_totale_kg']}");
        $section->addText("Quantité d'eau totale (litres) : {$results['quantite_eau_totale_litres']}");
        $section->addText("Débit d'eau (litres/minute) : {$results['debit_eau_litres_minute']}");
        $section->addText("Période d'application (heures) : {$results['periode_application_heures']}");
        $section->addText("Période d'application (minutes) : {$results['periode_application_minutes']}");

        // Enregistrer le document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(storage_path('results.docx'));

        // Télécharger le document
        return response()->download(storage_path('results.docx'))->deleteFileAfterSend(true);
    }
}
