<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medecin = auth()->user()->medecin;
        return view('medecin.index', compact('medecin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    //public function create()
    //{
        
   // }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(Request $request)
   // {
        //
   // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(auth()->user()->medecin->id != $id, 403);
        $medecin = Medecin::findOrFail($id);
        return view('medecin.show', compact('medecin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(auth()->user()->medecin->id != $id, 403);
        $medecin = Medecin::findOrFail($id);
        return view('medecin.edit', compact('medecin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(auth()->user()->medecin->id != $id, 403);
        try{
             $medecin = Medecin::findOrFail($id);

        $request->validate([
            'nom'=>'required|string|max:50',
            'prenom'=>'required|string|max:50',
            'email'=>'required|string|max:30|unique:medecins,email,'.$id.',id_med',
            'specialite'=>'required|string|max:50',
            'telephone'=>'required|string|max:30'

        ]);

        $medecin->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'specialite'=>$request->specialite,
            'email'=>$request->email,
            'telephone'=>$request->telephone
        ]);

        return redirect()->route('medecin.index')->with('success', 'Médecin modifié avec succés!');
                
        } catch(\Throwable $th){
            return redirect()->route('medecin.edit', ['id'=> $id])->with('error', 'Erreur lors de la modification!'.$th->getMessage());
        }
        }
            
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(auth()->user()->medecin->id != $id, 403);
        try{
            $medecin = Medecin::findOrFail($id);
            $medecin->delete();

            return redirect()->route('medecin.index')->with('success', 'Médecin supprimé avec succés!');

        }catch(\Throwable $th){
            return redirect()->route('medecin.index')->with('error', 'Erreur lors de la supression!'.$th->getMessage());
        }
    }
}



