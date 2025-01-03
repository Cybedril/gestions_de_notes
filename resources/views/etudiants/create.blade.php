@extends('layouts.app')

@section('content')
    <h1>Ajouter un étudiant</h1>
    <form action="{{ route('etudiants.store') }}" method="POST">
        @csrf
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" name="email" required>

        <button type="submit">Ajouter</button>
    </form>
@endsection
