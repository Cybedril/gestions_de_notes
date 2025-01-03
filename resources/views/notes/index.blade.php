<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Notes</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Liste des Notes</h1>
    <table>
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>EC</th>
                <th>Note</th>
                <th>Session</th>
                <th>Date d'Évaluation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{ $note->etudiant->nom }}</td>
                    <td>{{ $note->ec->nom }}</td>
                    <td>{{ $note->note }}</td>
                    <td>{{ $note->session }}</td>
                    <td>{{ $note->date_evaluation }}</td>
                    <td>{{ $ue->moyenneParEtudiant($etudiant->id) }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
