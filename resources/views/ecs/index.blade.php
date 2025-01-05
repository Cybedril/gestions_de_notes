<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des ECs</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Menu et Actions Rapides -->
    <header class="bg-indigo-600 text-white py-4 px-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Gestion des Éléments Constitutifs</h1>
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
        <!-- Section Liste des ECs -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des Éléments Constitutifs (ECs)</h2>

            <!-- Message de succès -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-md">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Lien pour ajouter un nouvel EC -->
            <a href="{{ route('ecs.create') }}" class="text-indigo-600 hover:text-indigo-800 text-lg font-semibold mb-4 inline-block">Ajouter un Nouvel EC</a>

            <!-- Liste des ECs -->
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-6 py-3 text-left">Code</th>
                        <th class="px-6 py-3 text-left">Nom</th>
                        <th class="px-6 py-3 text-left">Coefficient</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ecs as $ec)
                        <tr class="border-t border-gray-300">
                            <td class="px-6 py-3">{{ $ec->code }}</td>
                            <td class="px-6 py-3">{{ $ec->nom }}</td>
                            <td class="px-6 py-3">{{ $ec->coefficient }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('ecs.edit', $ec->id) }}" class="text-indigo-600 hover:text-indigo-800 mr-4">Modifier</a>
                                <form action="{{ route('ecs.destroy', $ec->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet EC ?')">Supprimer</button>
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
        <p>&copy; {{ date('Y') }} - Système de Gestion des Éléments Constitutifs</p>
    </footer>

</body>
</html>
