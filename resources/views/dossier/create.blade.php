@extends('layouts.app')
@section('title', 'Créer un dossier')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-folder-plus me-2"></i> Créer un dossier médical
            </div>
            <div class="card-body p-4">
                <form action="{{ route('dossier.save',$id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Antécédents médicaux</label>
                        <textarea name="antecedents" rows="4"
                                  class="form-control @error('antecedents') is-invalid @enderror"
                                  placeholder="Maladies, allergies, chirurgies passées...">{{ old('antecedents') }}</textarea>
                        @error('antecedents') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Traitement en cours</label>
                        <textarea name="traitement_en_cours" rows="4"
                                  class="form-control @error('traitement_en_cours') is-invalid @enderror"
                                  placeholder="Médicaments, posologie...">{{ old('traitement_en_cours') }}</textarea>
                        @error('traitement_en_cours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Créer le dossier
                        </button>
                        <a href="{{ route('patient.show', $id) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection