<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;
    protected $table = 'dossiers';

    protected $fillable = [
        'antecedents',
        'traitement_en_cours',
        'patient_id'

    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
