<!-- resources/views/admin/users/edit.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Modifier l'Utilisateur</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="role">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>