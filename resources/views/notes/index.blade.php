<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Notes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-center text-gray-800 mb-8">Liste des Notes</h1>

        <!-- Bouton pour ajouter une note -->
        <div class="mb-4 text-right">
            <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Ajouter une note</a>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Étudiant</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">EC</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Note</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Session</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Date d'Évaluation</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Moyenne</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($notes as $note)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</td>
                            <td class="px-6 py-4">{{ $note->ec->nom }}</td>
                            <td class="px-6 py-4">{{ $note->note }}</td>
                            <td class="px-6 py-4">{{ ucfirst($note->session) }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($note->date_evaluation)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">
                                {{ $note->etudiant->moyenne() }} <!-- Assurez-vous que la méthode moyenne() est définie dans le modèle Étudiant -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
