<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Étudiants</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Résultats des Étudiants</h1>

    <!-- Table des résultats -->
    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Niveau</th>
                <th>Crédits Acquis</th>
                <th>Peut Passer ?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->niveau }}</td>
                    <td>{{ $etudiant->creditsAcquis() }}</td>
                    <td>{{ $etudiant->peutPasser() ? 'Oui' : 'Non' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
