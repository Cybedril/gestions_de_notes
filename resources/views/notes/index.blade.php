<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Notes</title>
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
        <!-- Section Liste des Notes -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des Notes</h2>

            <!-- Message de succès -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-md">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Lien pour ajouter une nouvelle note -->
            <a href="{{ route('notes.create') }}" class="text-indigo-600 hover:text-indigo-800 text-lg font-semibold mb-4 inline-block">Ajouter une Nouvelle Note</a>

            <!-- Tableau des notes -->
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-6 py-3 text-left">Étudiant</th>
                        <th class="px-6 py-3 text-left">EC</th>
                        <th class="px-6 py-3 text-left">Note</th>
                        <th class="px-6 py-3 text-left">Session</th>
                        <th class="px-6 py-3 text-left">Date d'Évaluation</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                        <tr class="border-t border-gray-300">
                            <td class="px-6 py-3">{{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</td>
                            <td class="px-6 py-3">{{ $note->ec->nom }}</td>
                            <td class="px-6 py-3">{{ $note->note }}</td>
                            <td class="px-6 py-3">{{ ucfirst($note->session) }}</td>
                            <td class="px-6 py-3">{{ $note->date_evaluation }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('notes.edit', $note->id) }}" class="text-indigo-600 hover:text-indigo-800 mr-4">Modifier</a>
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">Supprimer</button>
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
                <li><a href="{{ route('notes.create') }}" class="text-indigo-600 hover:text-indigo-800">Ajouter une note</a></li>
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
