<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Note</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Menu et Actions Rapides -->
    <header class="bg-indigo-600 text-white py-4 px-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Ajouter une Note</h1>
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
        <!-- Formulaire d'ajout de note -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Formulaire d'ajout de note</h2>

            <!-- Afficher les messages de succès -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

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

            <!-- Formulaire de saisie des notes -->
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="etudiant_id" class="block text-gray-700 font-semibold">Étudiant :</label>
                    <select name="etudiant_id" id="etudiant_id" class="w-full p-3 border border-gray-300 rounded-md" required>
                        @foreach($etudiants as $etudiant)
                            <option value="{{ $etudiant->id }}" {{ old('etudiant_id') == $etudiant->id ? 'selected' : '' }}>
                                {{ $etudiant->nom }} {{ $etudiant->prenom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="ec_id" class="block text-gray-700 font-semibold">Élément Constitutif (EC) :</label>
                    <select name="ec_id" id="ec_id" class="w-full p-3 border border-gray-300 rounded-md" required>
                        @foreach($ecs as $ec)
                            <option value="{{ $ec->id }}" {{ old('ec_id') == $ec->id ? 'selected' : '' }}>
                                {{ $ec->code }} - {{ $ec->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="note" class="block text-gray-700 font-semibold">Note :</label>
                    <input type="number" name="note" id="note" class="w-full p-3 border border-gray-300 rounded-md" min="0" max="20" step="0.25" value="{{ old('note') }}" required>
                </div>

                <div class="mb-6">
                    <label for="session" class="block text-gray-700 font-semibold">Session :</label>
                    <select name="session" id="session" class="w-full p-3 border border-gray-300 rounded-md" required>
                        <option value="normale" {{ old('session') == 'normale' ? 'selected' : '' }}>Session Normale</option>
                        <option value="rattrapage" {{ old('session') == 'rattrapage' ? 'selected' : '' }}>Rattrapage</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="date_evaluation" class="block text-gray-700 font-semibold">Date d'Évaluation :</label>
                    <input type="date" name="date_evaluation" id="date_evaluation" class="w-full p-3 border border-gray-300 rounded-md" value="{{ old('date_evaluation') }}" required>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">Enregistrer la Note</button>
            </form>
        </section>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-10">
        <p>&copy; {{ date('Y') }} - Système de Gestion des Notes</p>
    </footer>

</body>
</html>
