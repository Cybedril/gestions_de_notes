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

        <div class="bg-white p-6 shadow-lg rounded-lg">
            <!-- Tableau des informations de l'étudiant -->
            <table class="min-w-full bg-white border-separate border-spacing-0 shadow-md rounded-lg">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">ID</th>
                        <th class="px-6 py-3 text-left font-medium">Numéro Étudiant</th>
                        <th class="px-6 py-3 text-left font-medium">Nom</th>
                        <th class="px-6 py-3 text-left font-medium">Prénom</th>
                        <th class="px-6 py-3 text-left font-medium">Niveau</th>
                        <th class="px-6 py-3 text-left font-medium">Moyenne Globale</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-t border-gray-200">{{ $etudiant->id }}</td>
                        <td class="px-6 py-4 border-t border-gray-200">{{ $etudiant->matricule }}</td>
                        <td class="px-6 py-4 border-t border-gray-200">{{ $etudiant->nom }}</td>
                        <td class="px-6 py-4 border-t border-gray-200">{{ $etudiant->prenom }}</td>
                        <td class="px-6 py-4 border-t border-gray-200">{{ $etudiant->niveau }}</td>
                        <td class="px-6 py-4 border-t border-gray-200">{{ number_format($moyenneGlobale, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Moyenne par session -->
            <h3 class="mt-6 text-xl font-semibold text-gray-800">Moyenne par session</h3>
            <table class="min-w-full bg-white mt-4 border-separate border-spacing-0 shadow-md rounded-lg">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">Session</th>
                        <th class="px-6 py-3 text-left font-medium">Moyenne</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @if (!empty($notesParSession))
                        @foreach ($notesParSession as $session => $moyenneSession)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 border-t border-gray-200">{{ ucfirst($session) }}</td>
                                <td class="px-6 py-4 border-t border-gray-200">{{ number_format($moyenneSession, 2) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="px-6 py-4 border-t border-gray-200" colspan="2">Aucune note disponible pour cet étudiant.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Bouton pour revenir à la liste des notes -->
            <div class="mt-6 text-center">
                <a href="{{ route('notes.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Retour à la liste des notes</a>
            </div>
        </div>
    </div>

</body>
</html>
