<?php

namespace App\Http\Controllers;
use App\Models\Note;
use App\Models\EC;  
use App\Models\Etudiant;
use Illuminate\Http\Request;

class NoteController extends Controller
{ 
   
 
    public function index()
    {
        $notes = Note::all(); // This will fetch all the notes
            return view('notes.index', compact('notes'));
    }
    public function create()
    {
        $etudiants = Etudiant::all();
        $ecs = EC::all();
        return view('notes.create', compact('etudiants', 'ecs'));
    }
 
    public function store(Request $request)
{
    $request->validate([
        'etudiant_id' => 'required|exists:etudiants,id',
        'ec_id' => 'required|exists:elements_constitutifs,id',
        'note' => 'required|numeric|min:0|max:20',
        'session' => 'required|in:normale,rattrapage',
        'date_evaluation' => 'required|date',
    ]);

    $note = new Note([
        'etudiant_id' => $request->etudiant_id,
        'ec_id' => $request->ec_id,
        'note' => $request->note,
        'session' => $request->session,
        'date_evaluation' => $request->date_evaluation,
    ]);

    $note->save();

    return redirect()->route('notes.index')->with('success', 'Note ajoutée avec succès');
}
    // App\Http\Controllers\NoteController.php

public function calculerMoyenne($etudiantId)
{
    $etudiant = Etudiant::findOrFail($etudiantId);
    $notes = Note::where('etudiant_id', $etudiantId)->get();

    $moyenne = $notes->avg('note');
    $notesParSession = $notes->groupBy('session')->map(function ($sessionNotes) {
        return $sessionNotes->avg('note');
    });

    return view('notes.moyenne', compact('etudiant', 'moyenne', 'notesParSession'));
}

public function show($id)
{
    // Récupérer les informations de l'étudiant par son ID
    $etudiant = Etudiant::find($id);

    // Vérifier si l'étudiant existe
    if (!$etudiant) {
        return abort(404, 'Étudiant non trouvé');
    }

    // Calculer la moyenne globale de l'étudiant (par défaut 0.00 si pas de notes)
    $moyenneGlobale = $etudiant->notes()->avg('moyenne') ?? 0.00;

    // Récupérer les moyennes par session
    $moyennesParSession = $etudiant->notes()
        ->selectRaw('session, AVG(moyenne) as moyenne_session')
        ->groupBy('session')
        ->get();

    // Retourner les données à la vue
    return view('notes.show', [
        'etudiant' => $etudiant,
        'moyenneGlobale' => number_format($moyenneGlobale, 2),
        'moyennesParSession' => $moyennesParSession,
    ]);
}
public function edit($id)
{
    $note = Note::findOrFail($id);
    $etudiants = Etudiant::all();
    $ecs = Ec::all();
    return view('notes.edit', compact('note', 'etudiants', 'ecs'));
}

    public function results($id)
    {
        $note = Note::findOrFail($id); // Récupère la note
        return view('notes.results', compact('notes')); // Passe la note à la vue
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id); // Récupère la note
        $note->delete(); // Supprime la note

        return redirect()->route('notes.index')->with('success', 'Note supprimée avec succès.');
    }

    public function update(Request $request, $id)
{
    // Valider les données envoyées
    $request->validate([
        'etudiant_id' => 'required|exists:etudiants,id',
        'ec_id' => 'required|exists:ecs,id',
        'note' => 'required|numeric|min:0|max:20',
        'session' => 'required|in:normale,rattrapage',
        'date_evaluation' => 'required|date', // Validation pour la date
    ]);

    // Trouver la note à mettre à jour
    $note = Note::findOrFail($id);

    // Mettre à jour les données de la note
    $note->etudiant_id = $request->etudiant_id;
    $note->ec_id = $request->ec_id;
    $note->note = $request->note;
    $note->session = $request->session;
    $note->date_evaluation = $request->date_evaluation; // Mettre à jour la date d'évaluation
    $note->save();

    // Retourner à la liste des notes avec un message de succès
    return redirect()->route('notes.index')->with('success', 'Note modifiée avec succès.');
}


}
