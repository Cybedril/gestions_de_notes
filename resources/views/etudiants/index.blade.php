<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Liste des étudiants</h1>

        <!-- Message de succès -->
        @if (session('success'))
            <div class="bg-green-200 p-4 rounded-md mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('debug'))
    <div class="bg-yellow-200 p-4 rounded-md mb-4 text-yellow-700">
        {{ session('debug') }}
    </div>
@endif

@foreach ($etudiants as $etudiant)
    <tr>
        <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
        <td>
            <a href="{{ route('notes.moyenne', $etudiant->id) }}" class="text-blue-500 hover:underline">Voir les moyennes</a>
        </td>
    </tr>
@endforeach



        <!-- Bouton pour ajouter un étudiant -->
        <div class="mb-4 text-right">
            <a href="{{ route('etudiants.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Ajouter un étudiant
            </a>
        </div>

        <!-- Tableau des étudiants -->
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Numéro Étudiant</th>
                    <th class="px-6 py-3 text-left">Nom</th>
                    <th class="px-6 py-3 text-left">Prénom</th>
                    <th class="px-6 py-3 text-left">Niveau</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiants as $etudiant)
                    <tr>
                        <td class="px-6 py-3">{{ $etudiant->id }}</td>
                        <td class="px-6 py-3">{{ $etudiant->numero_etudiant }}</td>
                        <td class="px-6 py-3">{{ $etudiant->nom }}</td>
                        <td class="px-6 py-3">{{ $etudiant->prenom }}</td>
                        <td class="px-6 py-3">{{ $etudiant->niveau }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="text-yellow-500 hover:text-yellow-700">Modifier</a>
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-4">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination si nécessaire -->
        <div class="mt-4">
            {{ $etudiants->links() }}
        </div>
    </div>
</body>
</html>
