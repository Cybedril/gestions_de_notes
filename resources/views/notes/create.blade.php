<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une note</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Ajouter une note</h1>

        @if (session('success'))
            <div class="bg-green-200 p-4 rounded-md mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('notes.store') }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
            @csrf

            <div class="mb-4">
                <label for="etudiant_id" class="block text-sm font-medium text-gray-700">Sélectionner un étudiant</label>
                <select name="etudiant_id" id="etudiant_id" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    onchange="redirectToEtudiantPage()">
                    <option value="">Choisir un étudiant</option>
                    @foreach ($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenom }}</option>
                    @endforeach
                </select>
                @error('etudiant_id')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
    <label for="ec_id" class="block text-sm font-medium text-gray-700">Sélectionner un EC</label>
    <select name="ec_id" id="ec_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">Choisir un EC</option>
        @foreach ($ecs as $ec)
            <option value="{{ $ec->id }}">{{ $ec->name }}</option> <!-- Assure-toi que 'name' est le bon champ dans le modèle EC -->
        @endforeach
    </select>
    @error('ec_id')
        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
    @enderror
</div>


            <div class="mb-4">
                <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                <input type="number" name="note" id="note" min="0" max="20" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('note')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
                <select name="session" id="session" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="normale">Normale</option>
                    <option value="rattrapage">Rattrapage</option>
                </select>
                @error('session')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Ajouter la note</button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('notes.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Retour à la liste des notes</a>
        </div>
    </div>

    <script>
        function redirectToEtudiantPage() {
            var etudiantId = document.getElementById("etudiant_id").value;
            if (etudiantId) {
                // Redirige vers la page des détails de l'étudiant
                window.location.href = '/etudiants/' + etudiantId;
            }
        }
    </script>
</body>
</html>
