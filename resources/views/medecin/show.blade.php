@extends('layouts.app')
@section('title', 'Profil médecin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-person-badge me-2"></i> Profil de Dr. {{ $medecin->Nom }} {{ $medecin->Prenom }}
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Nom</div>
                    <div class="col-sm-8 fw-semibold">{{ $medecin->Nom }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Prénom</div>
                    <div class="col-sm-8 fw-semibold">{{ $medecin->Prenom }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Spécialité</div>
                    <div class="col-sm-8">{{ $medecin->Specialite }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Email</div>
                    <div class="col-sm-8">{{ $medecin->Email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Téléphone</div>
                    <div class="col-sm-8">{{ $medecin->Telephone }}</div>
                </div>
                <a href="{{ route('medecin.edit', $medecin->id) }}" class="btn btn-primary mt-3">
                    <i class="bi bi-pencil me-1"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection