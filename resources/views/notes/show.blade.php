<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'Étudiant</title>
</head>
<body>
    <h1>Détail de l'Étudiant</h1>

    <p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
    <p><strong>Prénom :</strong> {{ $etudiant->prenom }}</p>
    <p><strong>Niveau :</strong> {{ $etudiant->niveau }}</p>

    <h2>Moyenne Globale : {{ $moyenneGlobale }}</h2>

    <h3>Moyenne par session :</h3>
    <ul>
        @forelse ($moyennesParSession as $session)
            <li>
                <strong>Session {{ $session->session }} :</strong> {{ number_format($session->moyenne_session, 2) }}
            </li>
        @empty
            <li>Aucune moyenne disponible pour les sessions.</li>
        @endforelse
    </ul>

    <a href="{{ route('notes.index') }}">Retour à la liste des notes</a><br>
    <a href="{{ route('notes.details', $etudiant->id) }}">Voir la moyenne sur la page Détail de la Moyenne de l'Étudiant</a>
</body>
</html>
