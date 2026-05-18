<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {   $patients = Patient::all();
        return view('patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
   /* public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /*public function store(Request $request)
    {
        //
    }*/

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $patient = Patient::findOrFail($id);
        $request->validate([
            'nom'=>'required|string|max:50',
            'prenom'=>'required|string|max:50',
            'telephone'=>'required|string|max:30',
            'adresse'=>'required|string|max:30',
            'etat'=>'required|string|max:10'
        ]);

        $patient->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
            'etat'=>$request->etat
        ]);

        return redirect()->route('patient.index')->with('success', 'Patient modifié avec succés!');
        }catch(\Throwable $th){
            return redirect()->route('patient.edit',['id'=>$id])->with('error', 'Erreur lors de la modification du patient!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $patient = Patient::findOrFail($id);
            $patient->delete();

            return redirect()->route('patient.index')->with('success', 'Patient supprimé avec succés!');

        }catch(\Throwable $th){
            return redirect()->route('patient.index')->with('error', 'Erreur lors de la suppression du patient!');
        }
    }

    public function patientDashboard()
    {
        $patient = auth()->user()->patient;
        return view('patient.dashboard', compact('patient'));
    }

}
