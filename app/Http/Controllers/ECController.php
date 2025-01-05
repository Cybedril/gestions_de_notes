<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EC;
use App\Models\UE;
use App\Models\Etudiant; // Si vous voulez aussi passer les étudiants dans le formulaire de création

class ECController extends Controller
{
    // Affiche la liste des ECs et les UEs pour le formulaire
    public function index()
    {
        $ecs = EC::with('ue')->get(); 
        $ues = UE::all(); // Liste des UEs pour l'affichage dans le formulaire
        return view('ecs.index', compact('ecs', 'ues'));
    }

    // Affiche le formulaire de création d'un EC
    public function create()
    {
        // Récupérer tous les EC (Éléments Constituants)
        $ecs = EC::all();
        $ues = UE::all(); // Récupère toutes les UEs
        // Récupérer tous les étudiants (si nécessaire pour le formulaire)
        $etudiants = Etudiant::all();

        // Passer les EC et les étudiants à la vue du formulaire d'ajout de note
        return view('ecs.create', compact('ues', 'etudiants'));
    }

    // Stocke un nouvel EC
    public function store(Request $request)
    {
        // Validation des données reçues (assurez-vous de valider les champs nécessaires)
        $validated = $request->validate([
            'code' => 'required',
            'coefficient' => 'required|numeric',
            'ue_id' => 'required|exists:unites_enseignements,id',  // Exemple de validation pour UE
            'nom' => 'required|string',  // Ajoutez une validation pour 'nom'
        ]);

        // Insertion des données dans la base de données
        EC::create([
            'code' => $validated['code'],
            'coefficient' => $validated['coefficient'],
            'ue_id' => $validated['ue_id'],
            'nom' => $validated['nom'],  // Assurez-vous d'ajouter 'nom'
        ]);

        // Rediriger ou renvoyer une réponse
        return redirect()->route('ecs.index')->with('success', 'EC ajouté avec succès.');
    }

    // Affiche le formulaire d'édition d'un EC
    public function edit($id)
    {
        $ec = EC::findOrFail($id);
        $ues = UE::all(); // Liste des UEs
        return view('ecs.edit', compact('ec', 'ues'));
    }

    // Affiche les détails d'un EC avec ses UE associés
    public function show($id)
    {
        // Trouver l'UE spécifique
        $ue = UE::find($id);  

        if (!$ue) {
            return redirect()->route('ecs.index')->with('error', 'UE non trouvée');
        }

        // Récupérer tous les ECs associés à cette UE
        $ecs = $ue->ecs; 

        return view('ecs.show', compact('ue', 'ecs')); // Passer l'UE et ses ECs à la vue
    }

    // Met à jour un EC existant
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'code' => 'required',
            'nom' => 'required|string',
            'coefficient' => 'required|integer|between:1,5',
            'ue_id' => 'required|exists:unites_enseignement,id',
        ]);

        // Récupération de l'EC et mise à jour
        $ec = EC::findOrFail($id);
        $ec->update($validated);

        // Rediriger avec un message de succès
        return redirect()->route('ecs.index')->with('success', 'L\'EC a été mis à jour avec succès!');
    }

    // Supprime un EC
    public function destroy($id)
    {
        $ec = EC::findOrFail($id);  // Récupère l'EC à supprimer
        $ec->delete();

        // Rediriger avec un message de succès
        return redirect()->route('ecs.index')->with('success', 'EC supprimé avec succès.');
    }
}
