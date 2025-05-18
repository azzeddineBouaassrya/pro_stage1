<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class FormulaireController extends Controller
{
    /**
     * Affiche le formulaire de calcul.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('forme.formulaire');
    }

    /**
     * Traite les données du formulaire et effectue les calculs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function calculer(Request $request)
    {
        // Validation des données du formulaire
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

        // Calculs supplémentaires
        $rinçage_eau = 3.5 * $surface; // Quantité d'eau de rinçage
        $rinçage_duree = $rinçage_eau / $debit_eau_litres_minute; // Durée de rinçage
        $controle_concentration = ($quantite_totale_litres / $quantite_eau_totale_litres) * 1000; // Contrôle de la concentration

        // Stocker les résultats dans un tableau
        $results = [
            'surface' => $surface,
            'quantite_totale_litres' => $quantite_totale_litres,
            'quantite_totale_kg' => $quantite_totale_kg,
            'quantite_eau_totale_litres' => $quantite_eau_totale_litres,
            'debit_eau_litres_minute' => $debit_eau_litres_minute,
            'periode_application_heures' => $periode_application_heures,
            'periode_application_minutes' => $periode_application_minutes,
            'rinçage_eau' => $rinçage_eau, // Ajouté
            'rinçage_duree' => $rinçage_duree, // Ajouté
            'controle_concentration' => $controle_concentration, // Ajouté
        ];

        // Stocker les résultats dans la session pour une utilisation ultérieure
        $request->session()->put('results', $results);

        // Retourner la vue avec les résultats
        return view('forme.resulta', compact('results'));
    }

    /**
     * Exporte les résultats en format Word (DOCX).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
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

        // Ajouter un titre au document
        $section->addText('Résultats du Calcul', ['bold' => true, 'size' => 16]);

        // Ajouter les résultats au document
        $section->addText("Surface : {$results['surface']} m²");
        $section->addText("Quantité totale de produit (litres) : {$results['quantite_totale_litres']}");
        $section->addText("Quantité totale de produit (kg) : {$results['quantite_totale_kg']}");
        $section->addText("Quantité d'eau totale (litres) : {$results['quantite_eau_totale_litres']}");
        $section->addText("Débit d'eau (litres/minute) : {$results['debit_eau_litres_minute']}");
        $section->addText("Période d'application (heures) : {$results['periode_application_heures']}");
        $section->addText("Période d'application (minutes) : {$results['periode_application_minutes']}");
        $section->addText("Rinçage (eau) : {$results['rinçage_eau']} litres"); // Ajouté
        $section->addText("Durée de rinçage : {$results['rinçage_duree']} minutes"); // Ajouté
        $section->addText("Contrôle de la concentration : {$results['controle_concentration']} %"); // Ajouté

        // Enregistrer le document temporairement
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $filePath = storage_path('results.docx');
        $objWriter->save($filePath);

        // Télécharger le document
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}