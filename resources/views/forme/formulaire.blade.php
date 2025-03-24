<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Calcul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }
        .logo:hover {
            transform: rotate(5deg) scale(1.1);
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px;
            font-size: 28px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-control {
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }
        .btn-custom {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9f5ff;
            border-radius: 10px;
            border-left: 5px solid #007bff;
            text-align: left;
        }
        .result h2 {
            color: #007bff;
        }
        .table {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .btn-group {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Ajout du logo -->
        <img src="{{ asset('cmgpcas.webp') }}" alt="Logo" class="logo">

        <h1>RAPPORT TRAITEMENT</h1>

        <!-- Formulaire de calcul -->
        <form action="{{ route('formulaire.calculer') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="longueur">Longueur de ligne (m)</label>
                <input type="number" step="0.01" class="form-control" id="longueur" name="longueur" value="{{ old('longueur') }}" required>
            </div>

            <div class="form-group">
                <label for="largeur">Largeur de ligne (m)</label>
                <input type="number" step="0.01" class="form-control" id="largeur" name="largeur" value="{{ old('largeur') }}" required>
            </div>

            <div class="form-group">
                <label for="nombre_lignes">Nombre de lignes</label>
                <input type="number" class="form-control" id="nombre_lignes" name="nombre_lignes" value="{{ old('nombre_lignes') }}" required>
            </div>

            <div class="form-group">
                <label for="quantite_produit_g">Quantité de produit (g/m²)</label>
                <input type="number" step="0.01" class="form-control" id="quantite_produit_g" name="quantite_produit_g" value="{{ old('quantite_produit_g') }}" required>
            </div>

            <div class="form-group">
                <label for="quantite_produit_cc">Quantité de produit (cc/m²)</label>
                <input type="number" step="0.01" class="form-control" id="quantite_produit_cc" name="quantite_produit_cc" value="{{ old('quantite_produit_cc') }}" required>
            </div>

            <div class="form-group">
                <label for="quantite_eau_litres_m2">Quantité d'eau (litres/m²)</label>
                <input type="number" step="0.01" class="form-control" id="quantite_eau_litres_m2" name="quantite_eau_litres_m2" value="{{ old('quantite_eau_litres_m2') }}" required>
            </div>

            <div class="form-group">
                <label for="debit_eau_litres_heure">Débit d'eau (litres/heure)</label>
                <input type="number" step="0.01" class="form-control" id="debit_eau_litres_heure" name="debit_eau_litres_heure" value="{{ old('debit_eau_litres_heure') }}" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-custom">Calculer</button>
                <button type="reset" class="btn btn-secondary btn-custom">Réinitialiser</button>
            </div>
        </form>

        <!-- Affichage des résultats -->
        @if(isset($results))
            <div class="result">
                <h2>Résultats</h2>
                <p><strong>Surface :</strong> {{ number_format($results['surface'], 2) }} m²</p>
                <p><strong>Quantité totale de produit (litres) :</strong> {{ number_format($results['quantite_totale_litres'], 2) }}</p>
                <p><strong>Quantité totale de produit (kg) :</strong> {{ number_format($results['quantite_totale_kg'], 2) }}</p>
                <p><strong>Quantité d'eau totale (litres) :</strong> {{ number_format($results['quantite_eau_totale_litres'], 2) }}</p>
                <p><strong>Débit d'eau (litres/minute) :</strong> {{ number_format($results['debit_eau_litres_minute'], 2) }}</p>
                <p><strong>Période d'application (heures) :</strong> {{ number_format($results['periode_application_heures'], 2) }}</p>
                <p><strong>Période d'application (minutes) :</strong> {{ number_format($results['periode_application_minutes'], 2) }}</p>
            </div>

            <!-- Bouton d'exportation -->
            <div class="text-center mt-3">
                <a href="{{ route('formulaire.export') }}" class="btn btn-success btn-custom">
                    <i class="bi bi-file-earmark-word"></i> Exporter en Word
                </a>
            </div>
        @endif
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</body>
</html>
