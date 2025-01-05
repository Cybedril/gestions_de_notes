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
        // Validation des données
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id', // Validation que l'étudiant existe
            'ec_id' => 'required|exists:elements_constitutifs,id', // Validation que l'EC existe
            'note' => 'required|numeric|min:0|max:20', // Validation de la note entre 0 et 20
        ]);

        // Création de la note
        $note = new Note();
        $note->etudiant_id = $request->etudiant_id;
        $note->ec_id = $request->ec_id;
        $note->note = $request->note;
        $note->session = $request->session;
        $note->date_evaluation = $request->date_evaluation;
        $note->save();

        // Redirection après enregistrement
        return redirect()->route('notes.index');
    }
    // App\Http\Controllers\NoteController.php

    public function calculerMoyenne($etudiantId)
    {
        $etudiant = Etudiant::findOrFail($etudiantId);
    
        // Récupère les notes de l'étudiant
        $notes = Note::where('etudiant_id', $etudiant->id)->get();
    
        // Calcul de la moyenne globale
        $totalNotes = $notes->sum('note');
        $nombreDeNotes = $notes->count();
    
        // Vérifie si l'étudiant a des notes
        if ($nombreDeNotes > 0) {
            $moyenneGlobale = $totalNotes / $nombreDeNotes;
        } else {
            $moyenneGlobale = 0;
        }
    
        // Moyennes par session
        $notesParSession = [];
        foreach ($notes as $note) {
            if ($note->session) {
                $session = $note->session->nom; // Assure-toi que ta table `notes` contient la relation vers `session`
                if (!isset($notesParSession[$session])) {
                    $notesParSession[$session] = [];
                }
                $notesParSession[$session][] = $note->note;
            }
        }
    
        // Calcul des moyennes par session
        $moyenneParSession = [];
        foreach ($notesParSession as $session => $sessionNotes) {
            $moyenneParSession[$session] = array_sum($sessionNotes) / count($sessionNotes);
        }
    
        // Retourner la vue avec les données
        return view('notes.moyenne', [
            'etudiant' => $etudiant,
            'moyenneGlobale' => $moyenneGlobale,
            'moyenneParSession' => $moyenneParSession,
            'notesParSession' => $notesParSession, // Ajout de cette ligne pour être sûr que la variable est définie
        ]);
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



}
