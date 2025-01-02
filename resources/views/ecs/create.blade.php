<!-- resources/views/ecs/create.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un EC</title>
</head>
<body>
    <h1>Ajout des ECs</h1>
    
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

    <!-- Formulaire de création d'un EC -->
    <form action="{{ route('ecs.store') }}" method="POST">
        @csrf
        <label for="code">Code :</label>
        <input type="text" name="code" id="code" required value="{{ old('code') }}">
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required value="{{ old('nom') }}">
        
        <label for="coefficient">Coefficient :</label>
        <input type="number" name="coefficient" id="coefficient" min="1" max="5" required value="{{ old('coefficient') }}">
        
        <label for="ue_id">UE Associée :</label>
        <select name="ue_id" id="ue_id" required>
            @foreach($ues as $ue)
                <option value="{{ $ue->id }}" {{ old('ue_id') == $ue->id ? 'selected' : '' }}>{{ $ue->nom }}</option>
            @endforeach
        </select>
        
        <button type="submit">Ajouter</button>
    </form>

</body>
</html>
