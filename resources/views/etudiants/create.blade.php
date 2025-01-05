<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Étudiant</title>
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
                    <li><a href="{{ route('ecs.index') }}" class="hover:text-indigo-300">EC</a></li>
                    <li><a href="{{ route('ues.index') }}" class="hover:text-indigo-300">UE</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-4 py-10">
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Créer un Étudiant</h2>
            <p class="text-gray-600 mb-6">Veuillez remplir les informations ci-dessous pour créer un nouvel étudiant.</p>

            <form action="{{ route('etudiants.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="numero_etudiant" class="block text-gray-700 font-medium mb-2">Numéro Étudiant :</label>
                    <input type="text" name="numero_etudiant" id="numero_etudiant" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label for="nom" class="block text-gray-700 font-medium mb-2">Nom :</label>
                    <input type="text" name="nom" id="nom" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label for="prenom" class="block text-gray-700 font-medium mb-2">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label for="niveau" class="block text-gray-700 font-medium mb-2">Niveau :</label>
                    <select name="niveau" id="niveau" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg shadow-md hover:bg-indigo-700 transition duration-200">Créer</button>
            </form>
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
