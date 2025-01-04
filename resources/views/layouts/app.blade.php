<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Notes')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Utilisation de Vite uniquement -->
</head>
<body class="bg-gray-100">
    <header>
        <nav class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Remplacer la route 'home' par la racine '/' ou une autre route -->
                <a href="/" class="text-2xl font-bold">Gestion des Notes</a> 
                <div>
                    <a href="{{ route('etudiants.create') }}" class="px-4 py-2 bg-green-500 rounded">Ajouter un étudiant</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>
