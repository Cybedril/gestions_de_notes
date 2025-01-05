<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Étudiant</title>
</head>
<body>
    <h1>Modifier l'Étudiant</h1>

    <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="numero_etudiant">Numéro Étudiant :</label>
        <input type="text" name="numero_etudiant" id="numero_etudiant" required value="{{ old('numero_etudiant', $etudiant->numero_etudiant) }}">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required value="{{ old('nom', $etudiant->nom) }}">

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required value="{{ old('prenom', $etudiant->prenom) }}">

        <label for="niveau">Niveau :</label>
        <select name="niveau" id="niveau" required>
            <option value="L1" {{ old('niveau', $etudiant->niveau) == 'L1' ? 'selected' : '' }}>L1</option>
            <option value="L2" {{ old('niveau', $etudiant->niveau) == 'L2' ? 'selected' : '' }}>L2</option>
            <option value="L3" {{ old('niveau', $etudiant->niveau) == 'L3' ? 'selected' : '' }}>L3</option>
        </select>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
