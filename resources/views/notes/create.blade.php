<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Note</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-center text-gray-800 mb-8">Ajouter une Note</h1>

        <!-- Affichage des messages d'erreur de validation -->
        @if($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded-lg">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notes.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Sélection Étudiant -->
            <div class="mb-4">
                <label for="etudiant_id" class="block text-sm font-medium text-gray-700">Étudiant</label>
                <select name="etudiant_id" id="etudiant_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenom }}</option>
                    @endforeach
                </select>
                @error('etudiant_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sélection EC -->
            <div class="mb-4">
                <label for="ec_id" class="block text-sm font-medium text-gray-700">EC</label>
                <select name="ec_id" id="ec_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    @foreach($ecs as $ec)
                        <option value="{{ $ec->id }}">{{ $ec->nom }}</option>
                    @endforeach
                </select>
                @error('ec_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sélection UE -->
            <div class="mb-4">
                <label for="ue_id" class="block text-sm font-medium text-gray-700">UE</label>
                <select name="ue_id" id="ue_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    @foreach($ues as $ue)
                        <option value="{{ $ue->id }}">{{ $ue->nom }}</option>
                    @endforeach
                </select>
                @error('ue_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Saisie de la Note -->
            <div class="mb-4">
                <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                <input type="number" name="note" id="note" min="0" max="20" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('note')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sélection Session -->
            <div class="mb-4">
                <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
                <select name="session" id="session" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="Normal">Normal</option>
                    <option value="Rattrapage">Rattrapage</option>
                </select>
                @error('session')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date d'Évaluation -->
            <div class="mb-4">
                <label for="date_evaluation" class="block text-sm font-medium text-gray-700">Date d'Évaluation</label>
                <input type="date" name="date_evaluation" id="date_evaluation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('date_evaluation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">Ajouter la note</button>
        </form>
    </div>

</body>
</html>
