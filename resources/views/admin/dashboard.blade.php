<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-primary {
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 8px;
            background: #007bff;
            border: none;
            transition: 0.3s ease-in-out;
            margin-top: 15px;
        }
        .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
        .logo {
            max-width: 120px;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }
        .logo:hover {
            transform: rotate(5deg) scale(1.1);
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
        <div class="dashboard-container">
            <div class="header">Tableau de Bord Administrateur</div>
            <img src="{{ asset('cmgpcas.webp') }}" alt="Logo" class="logo">
            <p class="lead">Bienvenue sur votre espace d'administration</p>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Gérer les Utilisateurs</a>
        </div>
    </div>
</body>
</html>
