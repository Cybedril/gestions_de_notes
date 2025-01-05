<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Note</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Modifier une Note</h1>

    <!-- Afficher les messages d'erreur -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire pour modifier une note -->
    <form action="{{ route('notes.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="etudiant_id">Étudiant :</label>
        <select name="etudiant_id" id="etudiant_id" required>
            @foreach($etudiants as $etudiant)
                <option value="{{ $etudiant->id }}" {{ $etudiant->id == $note->etudiant_id ? 'selected' : '' }}>
                    {{ $etudiant->nom }} {{ $etudiant->prenom }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label for="ec_id">Élément Constitutif (EC) :</label>
        <select name="ec_id" id="ec_id" required>
            @foreach($ecs as $ec)
                <option value="{{ $ec->id }}" {{ $ec->id == $note->ec_id ? 'selected' : '' }}>
                    {{ $ec->code }} - {{ $ec->nom }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label for="note">Note :</label>
        <input type="number" name="note" id="note" min="0" max="20" step="0.25" value="{{ $note->note }}" required>

        <br><br>

        <label for="session">Session :</label>
        <select name="session" id="session" required>
            <option value="normale" {{ $note->session == 'normale' ? 'selected' : '' }}>Session Normale</option>
            <option value="rattrapage" {{ $note->session == 'rattrapage' ? 'selected' : '' }}>Rattrapage</option>
        </select>

        <br><br>

        <button type="submit">Modifier la Note</button>
    </form>
</body>
</html>
