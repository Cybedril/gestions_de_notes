@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-8 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Ajouter un étudiant</h1>
        
        <form action="{{ route('etudiants.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="numero_etudiant" class="block text-lg font-medium text-gray-700">Numéro Étudiant :</label>
                <input type="text" name="numero_etudiant" id="numero_etudiant" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="nom" class="block text-lg font-medium text-gray-700">Nom :</label>
                <input type="text" name="nom" id="nom" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-lg font-medium text-gray-700">Prénom :</label>
                <input type="text" name="prenom" id="prenom" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="niveau" class="block text-lg font-medium text-gray-700">Niveau :</label>
                <select name="niveau" id="niveau" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                </select>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition-colors duration-300">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
@endsection
