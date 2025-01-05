<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\EC;
use App\Models\UE;  
  
use App\Models\Etudiant;
use Illuminate\Http\Request;


class NoteController extends Controller
{ 
    public function index()
    {
        $notes = Note::with(['etudiant', 'ec', 'ue'])->get();
        return view('notes.index', compact('notes'));
    }    public function create()
    {
        $etudiants = Etudiant::all();
        $ues = UE::all();
        $ecs = EC::all();
        return view('notes.create', compact('etudiants', 'ecs','ues'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'ec_id' => 'required|exists:e_c_s,id',
            'note' => 'required|numeric|min:0|max:20',
            'session' => 'required|string',
            'date_evaluation' => 'required|date',
        ]);

        $note = new Note();
        $note->etudiant_id = $request->etudiant_id;
        $note->ec_id = $request->ec_id;
        $note->note = $request->note;
        $note->session = $request->session;
        $note->date_evaluation = $request->date_evaluation;
        $note->save();

        return redirect()->route('notes.index')->with('success', 'La note a été ajoutée avec succès.');
    }

    public function calculerMoyenne($etudiantId)
    {
        $etudiant = Etudiant::findOrFail($etudiantId);
        $notes = Note::where('etudiant_id', $etudiant->id)->get();
        $totalNotes = $notes->sum('note');
        $nombreDeNotes = $notes->count();
        $moyenneGlobale = $nombreDeNotes > 0 ? $totalNotes / $nombreDeNotes : 0;
        $notesParSession = [];
        foreach ($notes as $note) {
            if (!isset($notesParSession[$note->session])) {
                $notesParSession[$note->session] = [];
            }
            $notesParSession[$note->session][] = $note->note;
        }

        $moyenneParSession = [];
        foreach ($notesParSession as $session => $sessionNotes) {
            $moyenneParSession[$session] = array_sum($sessionNotes) / count($sessionNotes);
        }

        return view('notes.moyenne', [
            'etudiant' => $etudiant,
            'moyenneGlobale' => $moyenneGlobale,
            'moyenneParSession' => $moyenneParSession,
            'notesParSession' => $notesParSession,
        ]);
    }

    public function show($id)
    {
        $etudiant = Etudiant::find($id);

        if (!$etudiant) {
            return abort(404, 'Étudiant non trouvé');
        }

        $moyenneGlobale = $etudiant->notes()->avg('note') ?? 0;
        $moyennesParSession = $etudiant->notes()
            ->selectRaw('session, AVG(note) as moyenne_session')
            ->groupBy('session')
            ->get();

        return view('notes.show', [
            'etudiant' => $etudiant,
            'moyenneGlobale' => number_format($moyenneGlobale, 2),
            'moyennesParSession' => $moyennesParSession,
        ]);
    }
}
