<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EC;
use App\Models\UE;

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
        $ues = UE::all(); // Pour sélectionner l'UE lors de la création
        return view('ecs.create', compact('ues'));
    }

    // Stocke un nouvel EC
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'code' => 'required|unique:elements_constitutifs,code',
            'nom' => 'required|string',
            'coefficient' => 'required|integer|between:1,5',
            'ue_id' => 'required|exists:unites_enseignement,id',
        ]);

        // Création de l'EC avec les données validées
        EC::create($validated);

        // Rediriger vers la page d'index avec un message de succès
        return redirect()->route('ecs.index')->with('success', 'L\'EC a été ajouté avec succès!');
    }

    // Affiche le formulaire d'édition d'un EC
    public function edit($id)
    {
        $ec = EC::findOrFail($id);
        $ues = UE::all();
        return view('ecs.edit', compact('ec', 'ues'));
    }

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
