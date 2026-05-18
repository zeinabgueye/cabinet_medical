@extends('layouts.app')
@section('title', 'Modifier mon profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-pencil me-2"></i> Modifier mon profil
            </div>
            <div class="card-body p-4">
                <form action="{{ route('medecin.update', $medecin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom', $medecin->nom) }}">
                        @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                               value="{{ old('prenom', $medecin->prenom) }}">
                        @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Spécialité</label>
                        <input type="text" name="specialite" class="form-control @error('specialite') is-invalid @enderror"
                               value="{{ old('specialite', $medecin->specialite) }}">
                        @error('specialite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $medecin->email) }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                               value="{{ old('telephone', $medecin->telephone) }}">
                        @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-save me-1"></i> Sauvegarder
                        </button>
                        <a href="{{ route('medecin.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection