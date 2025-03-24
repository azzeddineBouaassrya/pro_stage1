<!-- resources/views/admin/users/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 900px;
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
        .btn-custom {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
        .table {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #007bff;
            color: white;
        }
        .btn-group {
            display: flex;
            gap: 8px;
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

        <h1>Gestion des Utilisateurs</h1>

        <div class="d-flex justify-content-center gap-3 mb-3">
            <a href="{{ route('formulaire') }}" class="btn btn-primary btn-custom">Formulaire de Calcul</a>
            <a href="{{ route('users.create') }}" class="btn btn-success btn-custom">Ajouter un Utilisateur</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-custom">Modifier</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-custom">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
