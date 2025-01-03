<form action="{{ route('notes.store') }}" method="POST">
    @csrf
    <!-- Ajoutez ici les champs du formulaire pour les notes -->
    <button type="submit">Créer la note</button>
</form>
