<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Note</title>
</head>
<body>
    <h1>Ajouter une Note</h1>

    <!-- Afficher les messages de succès -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Afficher les erreurs de validation -->
    @if($errors->any())
        <div style="color: red;">
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

        <label for="etudiant_id">Étudiant :</label>
        <select name="etudiant_id" id="etudiant_id" required>
            @foreach($etudiants as $etudiant)
                <option value="{{ $etudiant->id }}" {{ old('etudiant_id') == $etudiant->id ? 'selected' : '' }}>
                    {{ $etudiant->nom }} {{ $etudiant->prenom }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label for="ec_id">Élément Constitutif (EC) :</label>
        <select name="ec_id" id="ec_id" required>
            @foreach($ecs as $ec)
                <option value="{{ $ec->id }}" {{ old('ec_id') == $ec->id ? 'selected' : '' }}>
                    {{ $ec->code }} - {{ $ec->nom }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label for="note">Note :</label>
        <input type="number" name="note" id="note" min="0" max="20" step="0.25" value="{{ old('note') }}" required>

        <br><br>

        <label for="session">Session :</label>
        <select name="session" id="session" required>
            <option value="normale" {{ old('session') == 'normale' ? 'selected' : '' }}>Session Normale</option>
            <option value="rattrapage" {{ old('session') == 'rattrapage' ? 'selected' : '' }}>Rattrapage</option>
        </select>

        <br><br>

        <label for="date_evaluation">Date d'Évaluation :</label>
        <input type="date" name="date_evaluation" id="date_evaluation" value="{{ old('date_evaluation') }}" required>

        <br><br>

        <button type="submit">Enregistrer la Note</button>
    </form>
</body>
</html>
