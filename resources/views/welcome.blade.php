<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900 font-inter">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold">Gestion des Notes</h1>
            <nav>
                <ul class="flex space-x-8 text-lg">
                    <li><a href="{{ route('etudiants.index') }}" class="hover:underline">Étudiants</a></li>
                    <li><a href="{{ route('notes.index') }}" class="hover:underline">Notes</a></li>
                    <li><a href="{{ route('ecs.index') }}" class="hover:underline">ÉC</a></li>
                    <li><a href="{{ route('ues.index') }}" class="hover:underline">UE</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10">
        <!-- Welcome Section -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Bienvenue</h2>
            <p class="text-gray-600 leading-relaxed">
                Découvrez un outil moderne pour gérer les étudiants, les UEs, les ECs et les notes. Utilisez les menus ci-dessus pour naviguer entre les différentes sections et profiter d'une interface intuitive.
            </p>
        </section>

        <!-- Actions Section -->
        <section>
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Actions rapides</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <a href="{{ route('etudiants.create') }}" class="block bg-gradient-to-r from-green-400 to-green-500 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <h4 class="text-lg font-semibold">Ajouter un Étudiant</h4>
                    <p class="text-sm mt-2">Créez un nouvel étudiant dans le système.</p>
                </a>
                <a href="{{ route('notes.create') }}" class="block bg-gradient-to-r from-yellow-400 to-yellow-500 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <h4 class="text-lg font-semibold">Ajouter des Notes</h4>
                    <p class="text-sm mt-2">Enregistrez les notes des étudiants.</p>
                </a>
                <a href="{{ route('ecs.create') }}" class="block bg-gradient-to-r from-purple-400 to-purple-500 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <h4 class="text-lg font-semibold">Créer un ÉC</h4>
                    <p class="text-sm mt-2">Ajoutez un nouvel élément constitutif.</p>
                </a>
                <a href="{{ route('ues.create') }}" class="block bg-gradient-to-r from-blue-400 to-blue-500 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <h4 class="text-lg font-semibold">Créer une UE</h4>
                    <p class="text-sm mt-2">Créez une nouvelle unité d'enseignement.</p>
                </a>
            </div>
        </section>
    </main>

   
</body>
</html>
