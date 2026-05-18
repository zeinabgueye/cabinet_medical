<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use Illuminate\Http\Request;

class OrdonnanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordonnances = Ordonnance::all();
        return view('ordonnance.index', compact('ordonnances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordonnance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'date'=>'required|date',
                'medicament'=>'required|string|max:50',
                'posologie'=>'required|string|max:250',
                'patient_id'=>'required|exists:patients,id'
            ]);

            Ordonnance::create([
                'date'=>$request->date,
                'medicament'=>$request->medicament,
                'posologie'=>$request->posologie,
                'patient_id'=>$request->patient_id,
                'medecin_id'=>auth()->user()->medecin->id
            ]);
            return redirect()->route('ordonnance.index')->with('success', 'Ordonnance créer avec succés!');
        }catch(\Throwable $th){
            return redirect()->route('ordonnance.create')->with('error', 'Erreur lors de la crétion de ordonnance '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ordonnance = Ordonnance::findOrFail($id);
        return view('ordonnance.show', compact('ordonnance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /*public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /*public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(string $id)
    {
        //
    }*/

    public function patientIndex()
    {
        $ordonnances = Ordonnance::where('Patient_id', auth()->user()->patient->id)->get();
        return view('ordonnance.patient', compact('ordonnances'));
    }
}
