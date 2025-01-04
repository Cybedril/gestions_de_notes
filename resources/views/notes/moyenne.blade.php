<!-- resources/views/notes/moyenne.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moyenne de l'Étudiant</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-center text-gray-800 mb-8">Détail de la Moyenne de l'Étudiant</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <!-- Informations de l'étudiant -->
            <h2 class="text-lg font-bold mb-4">Nom : {{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
            <p><strong>Matricule :</strong> {{ $etudiant->matricule }}</p>
            <p><strong>Email :</strong> {{ $etudiant->email }}</p>
            <p><strong>Filière :</strong> {{ $etudiant->filiere->nom ?? 'Non renseignée' }}</p>
            
            <!-- Moyenne globale -->
            <p class="mt-4"><strong>Moyenne Globale :</strong> {{ number_format($moyenne, 2) }}</p>

            <!-- Moyenne par session -->
            <h3 class="mt-4 text-lg font-bold">Moyenne par session :</h3>
            <ul>
                @foreach ($notesParSession as $session => $moyenneSession)
                    <li class="mt-2"><strong>{{ ucfirst($session) }} :</strong> {{ number_format($moyenneSession, 2) }}</li>
                @endforeach
            </ul>

            <!-- Bouton pour revenir à la liste des notes -->
            <div class="mt-6 text-center">
                <a href="{{ route('notes.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Retour à la liste des notes</a>
            </div>
            <a href="{{ route('notes.moyenne', $etudiant->id) }}">Voir la moyenne</a>
            
        </div>
    </div>

</body>
</html>
