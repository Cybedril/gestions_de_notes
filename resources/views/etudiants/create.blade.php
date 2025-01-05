<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Étudiant</title>
</head>
<body>
    <h1>Créer un Étudiant</h1>
    <form action="{{ route('etudiants.store') }}" method="POST">
        @csrf
        <label for="numero_etudiant">Numéro Étudiant :</label>
        <input type="text" name="numero_etudiant" id="numero_etudiant" required>

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>

        <label for="niveau">Niveau :</label>
        <select name="niveau" id="niveau" required>
            <option value="L1">L1</option>
            <option value="L2">L2</option>
            <option value="L3">L3</option>
        </select>

        <button type="submit">Créer</button>
    </form>
</body>
</html>
