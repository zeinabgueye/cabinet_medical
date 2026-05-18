<?php

namespace App\Models;

use App\Models\Ordonnance;
use App\Models\Rendezvous;
use App\Models\Dossier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';  


    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'etat',
        'user_id'

    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class, 'patient_id');
    }

    public function ordonnances()
    {
        return $this->hasMany(Ordonnance::class);
    }

    public function dossier()
    {
        return $this->hasOne(Dossier::class);
    }

    public function getNomCompletAttribute(): string
    {
        return $this->prenom.' '.$this->nom;
    }

}
