@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Modifier les informations de l'étudiant</h1>

    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Numéro Étudiant -->
            <div class="mb-4">
                <label for="numero_etudiant" class="block text-gray-700 font-medium mb-2">Numéro Étudiant</label>
                <input type="text" id="numero_etudiant" name="numero_etudiant" value="{{ $etudiant->numero_etudiant }}" class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-medium mb-2">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ $etudiant->nom }}" class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block text-gray-700 font-medium mb-2">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="{{ $etudiant->prenom }}" class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Niveau -->
            <div class="mb-4">
                <label for="niveau" class="block text-gray-700 font-medium mb-2">Niveau</label>
                <select id="niveau" name="niveau" class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="L1" {{ $etudiant->niveau == 'L1' ? 'selected' : '' }}>L1</option>
                    <option value="L2" {{ $etudiant->niveau == 'L2' ? 'selected' : '' }}>L2</option>
                    <option value="L3" {{ $etudiant->niveau == 'L3' ? 'selected' : '' }}>L3</option>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
