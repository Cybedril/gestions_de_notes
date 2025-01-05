<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EC;
use App\Models\UE;
use App\Models\Etudiant; // Si nécessaire pour les formulaires

class ECController extends Controller
{
    // Affiche la liste des ECs
    public function index()
    {
        $ecs = EC::with('ue')->get(); // Récupère tous les ECs avec les UEs associés
        return view('ecs.index', compact('ecs'));
    }

    // Affiche le formulaire de création d'un EC
    public function create()
    {
        // Récupérer toutes les UEs disponibles
        $ues = UE::all(); 

        return view('ecs.create', compact('ues'));
    }

    // Stocke un nouvel EC
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'code' => 'required|unique:e_c_s,code',  // Vérifier l'unicité du code dans la table EC
            'nom' => 'required|string',
            'coefficient' => 'required|integer|between:1,5',
            'ue_id' => 'required|exists:u_e_s,id',  // Vérifier l'existence de l'UE
        ]);

        // Création de l'EC avec les données validées
        EC::create($validated);

        // Rediriger vers la page de liste des ECs avec un message de succès
        return redirect()->route('ecs.index')->with('success', 'L\'EC a été ajouté avec succès!');
    }

    // Affiche le formulaire d'édition d'un EC
    public function edit($id)
    {
        $ec = EC::findOrFail($id); // Récupère l'EC à éditer
        $ues = UE::all(); // Liste des UEs disponibles
        return view('ecs.edit', compact('ec', 'ues'));
    }

    // Met à jour un EC existant
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'code' => 'required',
            'nom' => 'required|string',
            'coefficient' => 'required|integer|between:1,5',
            'ue_id' => 'required|exists:u_e_s,id',  // Vérification de l'UE
        ]);

        // Récupération et mise à jour de l'EC
        $ec = EC::findOrFail($id);
        $ec->update($validated);

        // Rediriger vers la liste avec un message de succès
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

    // Affiche les détails d'un EC avec ses UE associés
    public function show($id)
    {
        // Trouver l'EC avec ses informations associées
        $ec = EC::with('ue')->find($id);

        if (!$ec) {
            return redirect()->route('ecs.index')->with('error', 'EC non trouvé');
        }

        // Passer l'EC et son UE associé à la vue
        return view('ecs.show', compact('ec'));
    }
}
