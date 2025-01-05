<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Menu et Actions Rapides -->
    <header class="bg-indigo-600 text-white py-4 px-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Gestion des Notes</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('etudiants.index') }}" class="hover:text-indigo-300">Étudiants</a></li>
                    <li><a href="{{ route('notes.index') }}" class="hover:text-indigo-300">Notes</a></li>
                    <li><a href="{{ route('ecs.index') }}" class="hover:text-indigo-300">Éléments Constitutifs</a></li>
                    <li><a href="{{ route('ues.index') }}" class="hover:text-indigo-300">Unités d'Enseignement</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-4 py-10">
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des Étudiants</h2>
            <a href="{{ route('etudiants.create') }}" class="text-indigo-600 hover:text-indigo-800 text-lg font-semibold mb-4 inline-block">Créer un nouvel Étudiant</a>

            <!-- Table des étudiants -->
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-6 py-3 text-left">Numéro Étudiant</th>
                        <th class="px-6 py-3 text-left">Nom</th>
                        <th class="px-6 py-3 text-left">Prénom</th>
                        <th class="px-6 py-3 text-left">Niveau</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etudiants as $etudiant)
                        <tr class="border-t border-gray-300">
                            <td class="px-6 py-3">{{ $etudiant->numero_etudiant }}</td>
                            <td class="px-6 py-3">{{ $etudiant->nom }}</td>
                            <td class="px-6 py-3">{{ $etudiant->prenom }}</td>
                            <td class="px-6 py-3">{{ $etudiant->niveau }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="text-indigo-600 hover:text-indigo-800 mr-4">Modifier</a>
                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <!-- Actions Rapides -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Actions Rapides</h3>
            <ul class="space-y-4">
                <li><a href="{{ route('etudiants.create') }}" class="text-indigo-600 hover:text-indigo-800">Ajouter un étudiant</a></li>
                <li><a href="{{ route('notes.create') }}" class="text-indigo-600 hover:text-indigo-800">Ajouter des notes</a></li>
                <li><a href="{{ route('ecs.create') }}" class="text-indigo-600 hover:text-indigo-800">Créer un EC</a></li>
                <li><a href="{{ route('ues.create') }}" class="text-indigo-600 hover:text-indigo-800">Créer une UE</a></li>
            </ul>
        </section>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-10">
        <p>&copy; {{ date('Y') }} - Système de Gestion des Notes</p>
    </footer>

</body>
</html>
