<!-- resources/views/notes/results.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Étudiants</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Résultats des Étudiants</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left">Nom</th>
                    <th class="px-6 py-3 text-left">Prénom</th>
                    <th class="px-6 py-3 text-left">Niveau</th>
                    <th class="px-6 py-3 text-left">Crédits Acquis</th>
                    <th class="px-6 py-3 text-left">Peut Passer ?</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiants as $etudiant)
                    <tr>
                        <td class="px-6 py-3">{{ $etudiant->nom }}</td>
                        <td class="px-6 py-3">{{ $etudiant->prenom }}</td>
                        <td class="px-6 py-3">{{ $etudiant->niveau }}</td>
                        <td class="px-6 py-3">{{ $etudiant->credits_acquis }}</td>
                        <td class="px-6 py-3">{{ $etudiant->peut_passser ? 'Oui' : 'Non' }}</td>
                    </tr>
                @endforeach
                <a href="{{ route('notes.results') }}">Voir les résultats</a>

            </tbody>
        </table>
    </div>
</body>
</html>
