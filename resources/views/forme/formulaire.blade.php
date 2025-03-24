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
        .result p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">ROPPORT TRAITEMENT</h1>

        <!-- Formulaire de calcul -->
        <form action="{{ route('formulaire.calculer') }}" method="POST">
            @csrf

            <!-- Longueur de ligne -->
            <div class="form-group">
                <label for="longueur">Longueur de ligne (m)</label>
                <input type="number" step="0.01" class="form-control @error('longueur') is-invalid @enderror" id="longueur" name="longueur" value="{{ old('longueur') }}" required>
                @error('longueur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Largeur de ligne -->
            <div class="form-group">
                <label for="largeur">Largeur de ligne (m)</label>
                <input type="number" step="0.01" class="form-control @error('largeur') is-invalid @enderror" id="largeur" name="largeur" value="{{ old('largeur') }}" required>
                @error('largeur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nombre de lignes -->
            <div class="form-group">
                <label for="nombre_lignes">Nombre de lignes</label>
                <input type="number" class="form-control @error('nombre_lignes') is-invalid @enderror" id="nombre_lignes" name="nombre_lignes" value="{{ old('nombre_lignes') }}" required>
                @error('nombre_lignes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Quantité de produit (g/m²) -->
            <div class="form-group">
                <label for="quantite_produit_g">Quantité de produit (g/m²)</label>
                <input type="number" step="0.01" class="form-control @error('quantite_produit_g') is-invalid @enderror" id="quantite_produit_g" name="quantite_produit_g" value="{{ old('quantite_produit_g') }}" required>
                @error('quantite_produit_g')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Quantité de produit (cc/m²) -->
            <div class="form-group">
                <label for="quantite_produit_cc">Quantité de produit (cc/m²)</label>
                <input type="number" step="0.01" class="form-control @error('quantite_produit_cc') is-invalid @enderror" id="quantite_produit_cc" name="quantite_produit_cc" value="{{ old('quantite_produit_cc') }}" required>
                @error('quantite_produit_cc')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Quantité d'eau (litres/m²) -->
            <div class="form-group">
                <label for="quantite_eau_litres_m2">Quantité d'eau (litres/m²)</label>
                <input type="number" step="0.01" class="form-control @error('quantite_eau_litres_m2') is-invalid @enderror" id="quantite_eau_litres_m2" name="quantite_eau_litres_m2" value="{{ old('quantite_eau_litres_m2') }}" required>
                @error('quantite_eau_litres_m2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Débit d'eau (litres/heure) -->
            <div class="form-group">
                <label for="debit_eau_litres_heure">Débit d'eau (litres/heure)</label>
                <input type="number" step="0.01" class="form-control @error('debit_eau_litres_heure') is-invalid @enderror" id="debit_eau_litres_heure" name="debit_eau_litres_heure" value="{{ old('debit_eau_litres_heure') }}" required>
                @error('debit_eau_litres_heure')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Calculer</button>
                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
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
                <p><strong>Rinçage (eau) :</strong> {{ number_format($results['rinçage_eau'], 2) }} litres</p>
                <p><strong>Durée de rinçage :</strong> {{ number_format($results['rinçage_duree'], 2) }} minutes</p>
                <p><strong>Contrôle de la concentration :</strong> {{ number_format($results['controle_concentration'], 2) }} %</p>
            </div>

            <!-- Bouton d'exportation -->
            <div class="text-center mt-3">
                <a href="{{ route('formulaire.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-word"></i> Exporter en Word
                </a>
            </div>
        @endif
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</body>
</html>