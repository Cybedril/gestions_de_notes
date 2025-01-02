<!-- resources/views/ecs/edit.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un EC</title>
</head>
<body>
    <h1>Modifier l'EC - {{ $ec->code }}</h1>

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

    <!-- Formulaire de modification de l'EC -->
    <form action="{{ route('ecs.update', $ec->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="code">Code :</label>
        <input type="text" name="code" id="code" required value="{{ old('code', $ec->code) }}">
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required value="{{ old('nom', $ec->nom) }}">
        
        <label for="coefficient">Coefficient :</label>
        <input type="number" name="coefficient" id="coefficient" min="1" max="5" required value="{{ old('coefficient', $ec->coefficient) }}">
        
        <label for="ue_id">UE Associée :</label>
        <select name="ue_id" id="ue_id" required>
            @foreach($ues as $ue)
                <option value="{{ $ue->id }}" {{ old('ue_id', $ec->ue_id) == $ue->id ? 'selected' : '' }}>{{ $ue->nom }}</option>
            @endforeach
        </select>
        
        <button type="submit">Modifier</button>
    </form>

</body>
</html>
