<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des notes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Liste des notes</h1>

        @if (session('success'))
            <div class="bg-green-200 p-4 rounded-md mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 text-center">
            <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Ajouter une note</a>
        </div>

        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Étudiant</th>
                    <th class="px-4 py-2 border-b">EC</th>
                    <th class="px-4 py-2 border-b">Note</th>
                    <th class="px-4 py-2 border-b">Session</th>
                    <th class="px-4 py-2 border-b">UE</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</td>
                        <td class="px-4 py-2 border-b">{{ $note->ec->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $note->note }}</td>
                        <td class="px-4 py-2 border-b">{{ ucfirst($note->session) }}</td>
                        <td class="px-4 py-2 border-b">{{ $note->ue->nom }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('notes.edit', $note->id) }}" class="text-blue-500">Modifier</a>
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
