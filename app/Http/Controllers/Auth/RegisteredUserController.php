<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=>['required', 'in:medecin,patient'],
            'specialite'=>['required_if:role,medecin','nullable','string', 'max:50'],
            'telephone'=>['required', 'string', 'max:20'],
            'adresse'=>['required_if:role,patient','nullable', 'string', 'max:50'],],
    [
        'role.required'      => 'Veuillez choisir un rôle.',
        'role.in'            => 'Le rôle doit être médecin ou patient.',
        'telephone.required' => 'Le téléphone est obligatoire.',
        'name.required'      => 'Le nom est obligatoire.',
        'email.required'     => 'L\'email est obligatoire.',
        'email.unique'       => 'Cet email est déjà utilisé.',
        'password.required'  => 'Le mot de passe est obligatoire.',]
            );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
        ]);

        if($request->role==='medecin'){
            \App\Models\medecin::create([
                'nom'=>explode(' ',$request->name)[1]?? $request->name,
                'prenom'=>explode(' ',$request->name)[0],
                'specialite'=>$request->specialite,
                'email'=>$request->email,
                'telephone'=>$request->telephone,
                'user_id'=>$user->id,
            ]);
        }else{
            \App\Models\patient::create([
                'nom'=>explode(' ',$request->name)[1]?? $request->name,
                'prenom'=>explode(' ',$request->name)[0],
                'telephone'=>$request->telephone,
                'adresse'=>$request->adresse,
                'etat'=>'actif',
                'user_id'=>$user->id
                ]);
        }

        event(new Registered($user));
        Auth::login($user);

        if($request->role==='medecin'){
            return redirect()->route('medecin.index');
        }
        return redirect()->route('patient.dashboard');

        
    }
}
