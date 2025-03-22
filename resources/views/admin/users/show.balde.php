<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .user-details-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .user-details-container h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="user-details-container">
            <h1>Détails de l'Utilisateur</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">Rôle : <strong>{{ $user->role }}</strong></p>
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
