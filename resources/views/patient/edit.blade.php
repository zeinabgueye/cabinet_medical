@extends('layouts.app')
@section('title', 'Modifier patient')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-pencil me-2"></i> Modifier — {{ $patient->nom }} {{ $patient->prenom }}
            </div>
            <div class="card-body p-4">
                <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                                   value="{{ old('nom', $patient->nom) }}">
                            @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                                   value="{{ old('prenom', $patient->prenom) }}">
                            @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                   value="{{ old('telephone', $patient->telephone) }}">
                            @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">État</label>
                            <select name="etat" class="form-select @error('etat') is-invalid @enderror">
                                <option value="actif"   {{ old('etat', $patient->etat) === 'actif'   ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('etat', $patient->etat) === 'inactif' ? 'selected' : '' }}>Inactif</option>
                            </select>
                            @error('etat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                                   value="{{ old('adresse', $patient->adresse) }}">
                            @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Sauvegarder
                        </button>
                        <a href="{{ route('patient.show', $patient->id) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection