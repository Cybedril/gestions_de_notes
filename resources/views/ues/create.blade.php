<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une UE</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Menu principal -->
    <div class="bg-indigo-600 text-white py-4 px-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <a href="{{ route('etudiants.index') }}" class="hover:text-indigo-300 mr-6">Étudiants</a>
                <a href="{{ route('notes.index') }}" class="hover:text-indigo-300 mr-6">Notes</a>
                <a href="{{ route('ecs.index') }}" class="hover:text-indigo-300 mr-6">Éléments Constitutifs</a>
                <a href="{{ route('ues.index') }}" class="hover:text-indigo-300">Unités d'Enseignement</a>
            </div>
        </div>
    </div>

    <!-- Formulaire de création d'UE -->
    <div class="container mx-auto px-4 py-24 pt-24">
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Créer une Unité d'Enseignement (UE)</h2>

            <!-- Afficher les erreurs de validation -->
            @if($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-6">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire de saisie des données pour créer une UE -->
            <form action="{{ route('ues.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="code" class="block text-gray-700 font-semibold">Code UE :</label>
                    <input type="text" name="code" id="code" class="w-full p-3 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-6">
                    <label for="nom" class="block text-gray-700 font-semibold">Nom :</label>
                    <input type="text" name="nom" id="nom" class="w-full p-3 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-6">
                    <label for="credits_ects" class="block text-gray-700 font-semibold">Crédits ECTS :</label>
                    <input type="number" name="credits_ects" id="credits_ects" class="w-full p-3 border border-gray-300 rounded-md" min="1" max="30" required>
                </div>

                <div class="mb-6">
                    <label for="semestre" class="block text-gray-700 font-semibold">Semestre :</label>
                    <input type="number" name="semestre" id="semestre" class="w-full p-3 border border-gray-300 rounded-md" min="1" max="6" required>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">Créer l'UE</button>
            </form>
        </section>
    </div>

    <!-- Actions Rapides -->
    <div class="bg-indigo-600 text-white py-4 px-6 shadow-md fixed bottom-0 left-0 right-0">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <a href="{{ route('etudiants.index') }}" class="hover:text-indigo-300 mr-6">Étudiants</a>
                <a href="{{ route('notes.index') }}" class="hover:text-indigo-300 mr-6">Notes</a>
                <a href="{{ route('ecs.index') }}" class="hover:text-indigo-300 mr-6">Éléments Constitutifs</a>
                <a href="{{ route('ues.index') }}" class="hover:text-indigo-300">Unités d'Enseignement</a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-10">
        <p>&copy; {{ date('Y') }} - Système de Gestion des Notes</p>
    </footer>

</body>
</html>
