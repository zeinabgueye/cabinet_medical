<?php


use App\Http\Controllers\DossierController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezvousController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Le dashboard general:


//Routes pour le medecin

Route::middleware(['auth', 'verified', 'role:medecin'])->group(function(){
    Route::get('/medecin', [MedecinController::class, 'index'])->name('medecin.index');
Route::get('/medecin/edit/{id}', [MedecinController::class, 'edit'])->name('medecin.edit');
Route::get('/medecin/show/{id}', [MedecinController::class, 'show'])->name('medecin.show');
Route::put('/medecin/update/{id}', [MedecinController::class, 'update'])->name('medecin.update');
Route::delete('/medecin/delete/{id}', [MedecinController::class, 'destroy'])->name('medecin.delete');
//------------------------------------------------------------------------------------------

//Routes pour patient-----------------------------------------------------------------------

Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
Route::get('/patient/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit');
Route::get('/patient/show/{id}', [PatientController::class, 'show'])->name('patient.show');
Route::put('/patient/update/{id}', [PatientController::class, 'update'])->name('patient.update');
Route::delete('/patient/delete/{id}', [PatientController::class, 'destroy'])->name('patient.delete');
//------------------------------------------------------------------------------------------

//Routes ordonnances--------------------------------------------------------------------------
Route::get('/ordonnance', [OrdonnanceController::class, 'index'])->name('ordonnance.index');
Route::get('/ordonnance/show/{id}', [OrdonnanceController::class, 'show'])->name('ordonnance.show');
Route::get('/ordonnance/create', [OrdonnanceController::class, 'create'])->name('ordonnance.create');
Route::post('/ordonnance/save', [OrdonnanceController::class, 'store'])->name('ordonnance.save');
//--------------------------------------------------------------------------------------------

//Routes rendez-vous----------------------------------------------------------------------------
Route::get('/rendezvous', [RendezvousController::class, 'index'])->name('rendezvous.index');
Route::get('/rendezvous/show/{id}', [RendezvousController::class, 'show'])->name('rendezvous.show');
Route::get('/rendezvous/create/{id}', [RendezvousController::class, 'create'])->name('rendezvous.create');
Route::post('/rendezvous/save/{id}', [RendezvousController::class, 'store'])->name('rendezvous.save');
Route::get('/rendezvous/edit/{id}', [RendezvousController::class, 'edit'])->name('rendezvous.edit');
Route::delete('/rendezvous/delete/{id}', [RendezvousController::class, 'destroy'])->name('rendezvous.delete');
Route::put('/rendezvous/update/{id}', [RendezvousController::class, 'update'])->name('rendezvous.update');
//-------------------------------------------------------------------------------------------------

//Routes dossier------------------------------------------------------------------------------------
Route::get('/dossier', [DossierController::class, 'index'])->name('dossier.index');
Route::get('/dossier/show/{id}', [DossierController::class, 'show'])->name('dossier.show');
Route::get('/dossier/create/{id}', [DossierController::class, 'create'])->name('dossier.create');
Route::post('/dossier/save/{id}', [DossierController::class, 'store'])->name('dossier.save');
Route::get('/dossier/edit/{id}', [DossierController::class, 'edit'])->name('dossier.edit');
Route::put('/dossier/update/{id}', [DossierController::class, 'update'])->name('dossier.update');



});

Route::middleware(['auth', 'role:patient'])->group(function(){
    Route::get('mon/dashboard', [PatientController::class, 'patientDashboard'])->name('patient.dashboard');
    
    Route::get('mon/rendezvous/', [RendezvousController::class, 'patientIndex'])->name('patient.rendezvous');

    Route::get('mon/dossier/', [DossierController::class, 'patientShow'])->name('patient.dossier');

    Route::get('mon/ordonnance/', [OrdonnanceController::class, 'patientIndex'])->name('patient.ordonnance');

    Route::get('mon/rendezvous/create', [RendezvousController::class, 'patientCreate'])->name('patient.rendezvous.create');

    Route::post('mon/rendezvous/save', [RendezvousController::class, 'patientStore'])->name('patient.rendezvous.save');

    Route::delete('mon/rendezvous/delete/{id}/', [RendezvousController::class, 'patientDestroy'])->name('patient.rendezvous.delete');
});





require __DIR__.'/auth.php';


