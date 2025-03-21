<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Calcul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulaire de Calcul</h1>
        <form action="{{ route('formulaire.calculer') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="longueur">Longueur de ligne (m)</label>
                <input type="number" step="0.01" class="form-control" id="longueur" name="longueur" required>
            </div>
            <div class="form-group">
                <label for="largeur">Largeur de ligne (m)</label>
                <input type="number" step="0.01" class="form-control" id="largeur" name="largeur" required>
            </div>
            <div class="form-group">
                <label for="nombre_lignes">Nombre de lignes</label>
                <input type="number" class="form-control" id="nombre_lignes" name="nombre_lignes" required>
            </div>
            <div class="form-group">
                <label for="quantite_produit_g">Quantité de produit (g/m²)</label>
                <input type="number" step="0.01" class="form-control" id="quantite_produit_g" name="quantite_produit_g" required>
            </div>
            <div class="form-group">
                <label for="quantite_produit_cc">Quantité de produit (cc/m²)</label>
                <input type="number" step="0.01" class="form-control" id="quantite_produit_cc" name="quantite_produit_cc" required>
            </div>
            <div class="form-group">
                <label for="quantite_eau_litres_m2">Quantité d'eau (litres/m²)</label>
                <input type="number" step="0.01" class="form-control" id="quantite_eau_litres_m2" name="quantite_eau_litres_m2" required>
            </div>
            <div class="form-group">
                <label for="debit_eau_litres_heure">Débit d'eau (litres/heure)</label>
                <input type="number" step="0.01" class="form-control" id="debit_eau_litres_heure" name="debit_eau_litres_heure" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculer</button>
        </form>
    </div>
    <div>
        @if(isset($results))
            <div class="result">
                <h2>Résultats</h2>
                <p>Surface : {{ $results['surface'] }} m²</p>
                <p>Quantité totale de produit (litres) : {{ $results['quantite_totale_litres'] }}</p>
                <p>Quantité totale de produit (kg) : {{ $results['quantite_totale_kg'] }}</p>
                <p>Quantité d'eau totale (litres) : {{ $results['quantite_eau_totale_litres'] }}</p>
                <p>Débit d'eau (litres/minute) : {{ $results['debit_eau_litres_minute'] }}</p>
                <p>Période d'application (heures) : {{ $results['periode_application_heures'] }}</p>
                <p>Période d'application (minutes) : {{ $results['periode_application_minutes'] }}</p>
            </div>
            <a href="{{ route('formulaire.export') }}" class="btn btn-success">Exporter en Word</a>
        @endif
    </div>
</body>
</html>