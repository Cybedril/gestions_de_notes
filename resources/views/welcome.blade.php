<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <h1>Bienvenue dans le système de gestion des notes</h1>
        <nav>
            <ul>
                <li><a href="{{ route('etudiants.index') }}">Liste des Étudiants</a></li>
                <li><a href="{{ route('notes.index') }}">Notes</a></li>
                <li><a href="{{ route('ecs.index') }}">Éléments Constitutifs</a></li>
                <li><a href="{{ route('ues.index') }}">Unités d'Enseignement</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Gestion des Étudiants et Notes</h2>
            <p>Bienvenue dans l'application de gestion des étudiants, des UEs, des ECs et des notes. Vous pouvez accéder à la liste des étudiants, saisir des notes, créer et gérer des ECs et UEs à partir des menus ci-dessus.</p>
        </section>

        <section>
            <h3>Dernières actions</h3>
            <ul>
                <li><a href="{{ route('etudiants.create') }}">Ajouter un nouvel étudiant</a></li>
                <li><a href="{{ route('notes.create') }}">Ajouter des notes</a></li>
                <li><a href="{{ route('ecs.create') }}">Créer un nouvel élément constitutif</a></li>
                <li><a href="{{ route('ues.create') }}">Créer une nouvelle unité d'enseignement</a></li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} - Système de Gestion des Notes</p>
    </footer>
</body>
</html>
