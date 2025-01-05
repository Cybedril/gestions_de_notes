<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Moyenne de l'Étudiant</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-center text-gray-800 mb-8">Détails de la Moyenne de l'Étudiant</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <!-- Tableau des informations de l'étudiant -->
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">ID</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Numéro Étudiant</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Nom</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Prénom</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Niveau</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Moyenne Globale</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4">{{ $etudiant->id }}</td>
                        <td class="px-6 py-4">{{ $etudiant->matricule }}</td>
                        <td class="px-6 py-4">{{ $etudiant->nom }}</td>
                        <td class="px-6 py-4">{{ $etudiant->prenom }}</td>
                        <td class="px-6 py-4">{{ $etudiant->niveau }}</td>
                        <td class="px-6 py-4">{{ number_format($moyenneGlobale, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Moyenne par session -->
            <h3 class="mt-6 text-xl font-semibold">Moyenne par session</h3>
            <table class="min-w-full bg-white mt-4">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Session</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($notesParSession))
                        @foreach ($notesParSession as $session => $moyenneSession)
                            <tr>
                                <td class="px-6 py-4">{{ ucfirst($session) }}</td>
                                <td class="px-6 py-4">{{ number_format($moyenneSession, 2) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="px-6 py-4" colspan="2">Aucune note disponible pour cet étudiant.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Bouton pour revenir à la liste des notes -->
            <div class="mt-6 text-center">
                <a href="{{ route('notes.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Retour à la liste des notes</a>
            </div>
        </div>
    </div>

</body>
</html>
