@extends('layouts.app')
@section('title', 'Demander un rendez-vous')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-calendar-plus me-2"></i> Demander un rendez-vous
            </div>
            <div class="card-body p-4">
                <form action="{{ route('patient.rendezvous.save') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Médecin</label>
                        <select name="medecin_id" class="form-select @error('medecin_id') is-invalid @enderror" required>
                            <option value="">-- Choisir un médecin --</option>
                            @foreach(\App\Models\Medecin::all() as $medecin)
                            <option value="{{ $medecin->id }}"
                                {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}>
                                Dr. {{ $medecin->nom }} {{ $medecin->prenom }} — {{ $medecin->specialite }}
                            </option>
                            @endforeach
                        </select>
                        @error('medecin_id') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date & Heure souhaitée</label>
                        <input type="datetime-local" name="date_heure"
                               class="form-control @error('date_heure') is-invalid @enderror"
                               value="{{ old('date_heure') }}" required>
                        @error('date_heure') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Motif de la consultation</label>
                        <textarea name="motif" rows="3"
                                  class="form-control @error('motif') is-invalid @enderror"
                                  placeholder="Décrivez brièvement le motif..." required>{{ old('motif') }}</textarea>
                        @error('motif') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-1"></i>
                        Votre demande sera envoyée au médecin pour confirmation.
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-1"></i> Envoyer la demande
                        </button>
                        <a href="{{ route('patient.rendezvous') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection