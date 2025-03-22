<!-- resources/views/admin/users/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
        }
        .btn-group {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Utilisateurs</h1>
        <a href="{{ route('formulaire') }}" class="btn btn-primary mb-3">Accéder au Formulaire de Calcul</a>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Ajouter</a>


        <table class="table">
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
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
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