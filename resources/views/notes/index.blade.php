<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Notes</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Liste des Notes</h1>

    <!-- Afficher les messages de succès -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Lien pour ajouter une nouvelle note -->
    <a href="{{ route('notes.create') }}">Ajouter une Nouvelle Note</a>

    <!-- Tableau des notes -->
    <table border="1">
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>EC</th>
                <th>Note</th>
                <th>Session</th>
                <th>Date d'Évaluation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</td>
                    <td>{{ $note->ec->nom }}</td>
                    <td>{{ $note->note }}</td>
                    <td>{{ ucfirst($note->session) }}</td>
                    <td>{{ $note->date_evaluation }}</td>
                    <td>
                        <!-- Lien pour modifier -->
                        <a href="{{ route('notes.edit', $note->id) }}">Modifier</a>
                        <!-- Formulaire pour supprimer -->
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
