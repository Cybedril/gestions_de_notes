<!-- resources/views/ecs/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des ECs</title>
</head>
<body>
    <h1>Liste des ECs</h1>

    <!-- Afficher les messages de succès -->
    @if(session('success'))
        <div style="background-color: green; color: white; padding: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach($ecs as $ec)
            <li>{{ $ec->code }} - {{ $ec->nom }} - Coefficient: {{ $ec->coefficient }}
                <a href="{{ route('ecs.edit', $ec->id) }}">Modifier</a> |
                <form action="{{ route('ecs.destroy', $ec->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('ecs.create') }}">Ajouter un nouvel EC</a>

</body>
</html>
