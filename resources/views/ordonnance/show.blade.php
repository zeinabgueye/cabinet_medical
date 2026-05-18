@extends('layouts.app')
@section('title', 'Ordonnance')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-file-earmark-medical me-2"></i> Ordonnance</span>
                <span class="small opacity-75">{{ \Carbon\Carbon::parse($ordonnance->date)->format('d/m/Y') }}</span>
            </div>
            <div class="card-body p-4">

                {{-- Médecin --}}
                <div class="d-flex justify-content-between mb-4 pb-3 border-bottom">
                    <div>
                        <div class="fw-semibold">Dr. {{ $ordonnance->medecin->nom }} {{ $ordonnance->medecin->prenom }}</div>
                        <div class="text-muted small">{{ $ordonnance->medecin->specialite }}</div>
                        <div class="text-muted small">{{ $ordonnance->medecin->telephone }}</div>
                    </div>
                    <div class="text-end">
                        <div class="fw-semibold">Patient</div>
                        <div>{{ $ordonnance->patient->nom }} {{ $ordonnance->patient->prenom }}</div>
                    </div>
                </div>

                {{-- Médicament & posologie --}}
                <div class="mb-3">
                    <h6 class="text-muted mb-2">Médicament(s)</h6>
                    <p class="mb-0 p-3 bg-light rounded">{{ $ordonnance->medicament }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Posologie</h6>
                    <p class="mb-0 p-3 bg-light rounded">{{ $ordonnance->posologie }}</p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('ordonnance.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection