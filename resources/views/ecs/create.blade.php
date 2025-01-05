<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un EC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Ajout des ECs</h1>
    
    <!-- Afficher les erreurs de validation -->
    @if($errors->any())
        <div class="error">
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
        <input type="text" name="code" id="code" required value="{{ old('code') }}" placeholder="Entrez le code de l'EC">
        
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required value="{{ old('nom') }}" placeholder="Nom de l'EC">
        
        <label for="coefficient">Coefficient :</label>
        <input type="number" name="coefficient" id="coefficient" min="1" max="5" required value="{{ old('coefficient') }}" placeholder="Coefficient de l'EC">
        
        <label for="ue_id">UE Associée :</label>
        <select name="ue_id" id="ue_id" required>
            <option value="" disabled selected>Choisir une UE</option>
            @foreach($ues as $ue)
                <option value="{{ $ue->id }}" {{ old('ue_id') == $ue->id ? 'selected' : '' }}>{{ $ue->nom }}</option>
            @endforeach
        </select>
        
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
