<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        return view('etudiants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_etudiant' => 'required|unique:etudiants',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'niveau' => 'required|in:L1,L2,L3',
        ]);

        Etudiant::create($request->all());

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
    }
}
