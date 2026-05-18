<?php

namespace App\Models;

use App\Models\Ordonnance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Medecin extends Model
{
    use HasFactory;
    protected $table = 'medecins'; 


    protected $fillable = [
        'nom',
        'prenom',
        'specialite',
        'email',
        'telephone',
        'user_id'
    ];



    //@var list<string>

    protected $hidden = [
        'created_at',
        'updated_at',
        'password'
    ];

    protected function casts(): array
    {
        return[
            'email_verified_at'=>'datetime'
        ];
    }


    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class, 'medecin_id');
    }

    public function ordonnances()
    {
        return $this->hasMany(Ordonnance::class);
    }

    public function getNomCompletAttribute(): string
    {
        return 'Dr. '.$this->prenom.''.$this->nom;
    }
}