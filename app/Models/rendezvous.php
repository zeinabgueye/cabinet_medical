<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    use HasFactory;

    protected $table = 'rendezvous';


    protected $fillable = [
        'date_heure',
        'statut',
        'motif',
        'medecin_id',
        'patient_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected function casts(): array
    {
        return[
            'date_heure' => 'datetime'
        ];
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
