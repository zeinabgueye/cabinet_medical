<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dossiers = Dossier::all();
        return view('dossier.index', compact('dossiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {   //id du patient
        return view('dossier.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        try{
            $request->validate([
                'antecedents'=>'required|string|max:100',
                'traitement_en_cours'=>'required|string|max:150'
            ]);

            Dossier::create([
                'antecedents'=>$request->antecedents,
                'traitement_en_cours'=>$request->traitement_en_cours,
                'patient_id'=>$id
            ]);
            return redirect()->route('dossier.index')->with('success', 'Dossier créer avec succes!');
        }catch(\Throwable $th){
            return redirect()->route('dossier.create', ['id'=>$id])->with('error', 'Erreur lors de la creation du dossier!'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dossier = Dossier::findOrFail($id);
        return view('dossier.show', compact('dossier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dossier = Dossier::findOrFail($id);
        return view('dossier.edit', compact('dossier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $dossier = Dossier::findOrFail($id);

            $request->validate([
                'antecedents'=>'required|string|max:255',
                'traitement_en_cours'=>'required|string|max:255'
            ]);

            $dossier->update([
                'antecedents'=>$request->antecedents,
                'traitement_en_cours'=>$request->traitement_en_cours
            ]);

            return redirect()->route('dossier.index')->with('success','Dossier modifié avec succés!');
        }catch(\Throwable $th){
            return redirect()->route('dossier.edit',['id'=>$id])->with('error', 'Erreur lors de la modification du dossier!'.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(string $id)
    {
        //
    }*/

    public function patientShow()
    {
        $dossier = Dossier::where('patient_id', auth()->user()->patient->id)->first();
        
        return view('dossier.patient', compact('dossier'));
    }
}
