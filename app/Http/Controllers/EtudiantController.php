<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    // Afficher la liste des étudiants avec pagination
    public function index()
    {
        // Récupérer les étudiants avec pagination
        $etudiants = Etudiant::paginate(10);
        return view('etudiants.index', compact('etudiants'));
    }
    

    // Afficher le formulaire de création d'un étudiant
    public function create()
    {
        return view('etudiants.create');
    }

    // Sauvegarder un nouvel étudiant
    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'numero_etudiant' => 'required|unique:etudiants',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'niveau' => 'required|in:L1,L2,L3',
    ]);

    // Création de l'étudiant
    $etudiant = Etudiant::create([
        'numero_etudiant' => $request->numero_etudiant,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'niveau' => $request->niveau,
    ]);

    // Vérification si l'étudiant est bien créé
    if ($etudiant) {
        // Redirection vers la liste des étudiants avec un message de succès
        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
    } else {
        // Si l'ajout échoue, retour avec un message d'erreur
        return back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de l\'étudiant.');
    }
}

    

    // Mettre à jour les informations d'un étudiant
   

    public function update(Request $request, $id)
{
    // Valider les données
    $request->validate([
        'numero_etudiant' => 'required|string|max:255',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'niveau' => 'required|in:L1,L2,L3',
    ]);

    // Récupérer l'étudiant et mettre à jour les données
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->update([
        'numero_etudiant' => $request->numero_etudiant,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'niveau' => $request->niveau,
    ]);

    // Rediriger vers la liste des étudiants avec un message de succès
    return redirect()->route('etudiants.index')->with('success', 'Étudiant modifié avec succès.');
}


    // Supprimer un étudiant
    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        // Redirection après la suppression de l'étudiant avec un message de succès
        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant supprimé avec succès.');
    }

    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id); // Récupère l'étudiant avec l'ID donné
        return view('etudiants.edit', compact('etudiant')); // Retourne la vue d'édition avec les données de l'étudiant
    }
    public function show($id)
    {
        $etudiant = Etudiant::find($id);
    
        if (!$etudiant) {
            // Si l'étudiant n'est pas trouvé, renvoie une erreur ou redirige
            return redirect()->route('etudiants.index')->with('error', 'Étudiant non trouvé');
        }
    
        // Si l'étudiant est trouvé, retourne la vue avec les données de l'étudiant
        return view('etudiants.show', compact('etudiant'));
    }
      
    // EtudiantController.php
public function moyenne($etudiantId)
{
    $etudiant = Etudiant::findOrFail($etudiantId);
    $moyenne = $etudiant->notes->avg('note'); // Calcul de la moyenne des notes de l'étudiant
    return view('etudiants.moyenne', compact('etudiant', 'moyenne'));
}

}
