<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EC;
use App\Models\UE;


class UEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ues = UE::all();
    return view('ues.index', compact('ues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:unites_enseignement|alpha_num',
            'nom' => 'required',
            'credits_ects' => 'required|integer|min:1|max:30',
            'semestre' => 'required|integer|min:1|max:6',
        ]);
    
        UE::create($request->all());
        return redirect()->route('ues.index')->with('success', 'UE créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UE $ue)
    {
        return view('ues.edit', compact('ue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UE $ue)
    {
        $request->validate([
            'code' => 'required|unique:unites_enseignement,code,' . $ue->id,
            'nom' => 'required',
            'credits_ects' => 'required|integer|min:1|max:30',
            'semestre' => 'required|integer|min:1|max:6',
        ]);
    
        $ue->update($request->all());
        return redirect()->route('ues.index')->with('success', 'UE mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UE $ue)
    {
        $ue->delete();
    return redirect()->route('ues.index')->with('success', 'UE supprimée avec succès.');
    }
}
