<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\ElementConstitutif;
use Illuminate\Http\Request;
use App\Models\EC;


class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('etudiant', 'ec')->get();
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
        ]);
    
        Note::create($request->all());
    
        return redirect()->route('notes.index')->with('success', 'Note enregistrée avec succès !');
    }
    public function results()
{
    $etudiants = Etudiant::all();
    return view('notes.results', compact('etudiants'));
}


}
