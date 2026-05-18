<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rendezvous = Rendezvous::where('medecin_id', auth()->user()->medecin->id)->get();
        return view('rendezvous.index', compact('rendezvous'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('rendezvous.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        try{
            $request->validate([
                'date_heure'=>'required|date',
                'motif'=>'required|string|max:255'
            ]);

            Rendezvous::create([
                'date_heure'=>$request->date_heure,
                'motif'=>$request->motif,
                'statut'=>'confirme',
                'patient_id'=>$id,
                'medecin_id'=>auth()->user()->medecin->id

            ]);
            return redirect()->route('rendezvous.index')->with('success', 'Rrendez-vous créer avec succés!');

        }catch(\Throwable $th){
            return redirect()->route('rendezvous.create')->with('error', 'Erreur lors de la création!'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rendezvous = Rendezvous::findOrFail($id);
        return view('rendezvous.show', compact('rendezvous'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rendezvous = Rendezvous::findOrFail($id);
        return view('rendezvous.edit', compact('rendezvous')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $rendezvous = Rendezvous::findOrFail($id);
            $request->validate([
                'date_heure'=>'required|date',
                'motif'=>'required|string|max:255',
                'statut'=>'required|in:en_attente,confirme,annule'
            ]);

            $rendezvous->update([
                'date_heure'=>$request->date_heure,
                'motif'=>$request->motif,
                'statut'=>$request->statut
            ]);
            return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous modifié avec succés!');
        }catch(\Throwable $th){
            return redirect()->route('rendezvous.edit', ['id'=> $id])->with('error', 'Erreur lors de la modification du rendez-vous!'.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $rendezvous = Rendezvous::findOrFail($id);
            $rendezvous->delete();

            return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous supprimé avec succés!');

        }catch(\Throwable $th){
            return redirect()->route('rendezvous.index')->with('error', 'Suppression du rendez-vous a échouée!'.$th->getMessage());
        }
    }

    public function patientIndex(){
        $rendezvous = Rendezvous::where('patient_id', auth()->user()->patient->id)->get();
        return view('rendezvous.patient', compact('rendezvous'));
    }

    public function patientCreate(){
        return view('rendezvous.patient_create');
    }

    public function patientStore(Request $request){
        try{
            $request->validate([
                'date_heure'=>'required|date',
                'motif'=>'required|string|max:255',
                'medecin_id'=>'required|exists:medecins,id'
            ]);

            Rendezvous::create([
                'date_heure'=>$request->date_heure,
                'motif'=>$request->motif,
                'statut'=>'en_attente',
                'patient_id'=>auth()->user()->patient->id,
                'medecin_id'=>$request->medecin_id

            ]);
            return redirect()->route('patient.rendezvous')->with('success', 'Demande envoyée avec succées!');
        }catch(\Throwable $th){
            return redirect()->route('patient.rendezvous.create')->with('error', 'Erreur lors de la demande!'.$th->getMessage());
        }
    }

    public function patientDestroy(string $id){
        try{
            $rendezvous = Rendezvous::findOrFail($id);
            abort_if($rendezvous->patient_id != auth()->user()->patient->id, 403);

            $rendezvous->delete();
            return redirect()->route('patient.rendezvous')->with('success', 'Rendez-vous annulé!');
        }catch(\Throwable $th){
            return redirect()->route('patient.rendezvous')->with('error', 'Erreur durant l\'annulation!'.$th->getMessage());
        }

    }
}
