<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un EC</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Menu principal en haut -->
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

    <!-- Formulaire d'ajout d'EC -->
    <div class="container mx-auto px-4 py-24 pt-24">
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ajouter un Élément Constitutif (EC)</h2>

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

            <!-- Formulaire pour ajouter un EC -->
            <form action="{{ route('ecs.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="code" class="block text-gray-700 font-semibold">Code :</label>
                    <input type="text" name="code" id="code" class="w-full p-3 border border-gray-300 rounded-md" required value="{{ old('code') }}">
                </div>

                <div class="mb-6">
                    <label for="nom" class="block text-gray-700 font-semibold">Nom :</label>
                    <input type="text" name="nom" id="nom" class="w-full p-3 border border-gray-300 rounded-md" required value="{{ old('nom') }}">
                </div>

                <div class="mb-6">
                    <label for="coefficient" class="block text-gray-700 font-semibold">Coefficient :</label>
                    <input type="number" name="coefficient" id="coefficient" class="w-full p-3 border border-gray-300 rounded-md" min="1" max="5" required value="{{ old('coefficient') }}">
                </div>

                <div class="mb-6">
                    <label for="ue_id" class="block text-gray-700 font-semibold">UE Associée :</label>
                    <select name="ue_id" id="ue_id" class="w-full p-3 border border-gray-300 rounded-md" required>
                        @foreach($ues as $ue)
                            <option value="{{ $ue->id }}" {{ old('ue_id') == $ue->id ? 'selected' : '' }}>{{ $ue->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">Ajouter l'EC</button>
            </form>
        </section>
    </div>

    <!-- Actions rapides en bas -->
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
