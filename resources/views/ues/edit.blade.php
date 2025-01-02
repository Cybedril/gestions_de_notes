<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une UE</title>
</head>
<body>
    <h1>Modifier l'UE : {{ $ue->nom }}</h1>

    <form action="{{ route('ues.update', $ue->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="code">Code UE :</label>
        <input type="text" name="code" id="code" value="{{ $ue->code }}" required>
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="{{ $ue->nom }}" required>
        
        <label for="credits_ects">Crédits ECTS :</label>
        <input type="number" name="credits_ects" id="credits_ects" value="{{ $ue->credits_ects }}" min="1" max="30" required>
        
        <label for="semestre">Semestre :</label>
        <input type="number" name="semestre" id="semestre" value="{{ $ue->semestre }}" min="1" max="6" required>
        
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
