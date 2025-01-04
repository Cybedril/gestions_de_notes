<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'Étudiant</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-center text-gray-800 mb-8">Détails de l'Étudiant</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-lg font-bold mb-4">Nom : {{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
            <p><strong>Matricule :</strong> {{ $etudiant->matricule ?? 'Non renseigné' }}</p>
            <p><strong>Email :</strong> {{ $etudiant->email ?? 'Non renseigné' }}</p>
            <p><strong>Filière :</strong> {{ $etudiant->filiere->nom ?? 'Non renseignée' }}</p>
           
            <div class="mt-4 text-center">
                <a href="{{ route('etudiants.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Retour à la liste des étudiants</a>
            </div>
        </div>
    </div>

</body>
</html>
