<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .dashboard-container h1 {
            color: #007bff;
            margin-bottom: 20px;
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
        <div class="dashboard-container">
            <h1>Tableau de Bord Administrateur</h1>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Gérer les Utilisateurs</a>
        </div>
    </div>
</body>
</html>
