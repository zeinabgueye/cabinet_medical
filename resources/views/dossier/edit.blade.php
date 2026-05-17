@extends('layouts.app')
@section('title', 'Modifier dossier')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-pencil me-2"></i> Modifier le dossier</span>
                <span class="small opacity-75">
                    {{ $dossier->patient->Nom }} {{ $dossier->patient->Prenom }}
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('dossier.update', $dossier->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Antécédents médicaux</label>
                        <textarea name="antecedents" rows="4"
                                  class="form-control @error('antecedents') is-invalid @enderror">{{ old('antecedents', $dossier->antecedents) }}</textarea>
                        @error('antecedents') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Traitement en cours</label>
                        <textarea name="traitement_en_cours" rows="4"
                                  class="form-control @error('traitement_en_cours') is-invalid @enderror">{{ old('traitement_en_cours', $dossier->traitement_en_cours) }}</textarea>
                        @error('traitement_en_cours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Sauvegarder
                        </button>
                        <a href="{{ route('dossier.show', $dossier->id) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection