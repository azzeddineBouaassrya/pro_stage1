<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Ajouter un Utilisateur</h1>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="user">Utilisateur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>

</html>
