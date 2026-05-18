@extends('layouts.app')
@section('title', 'Mes ordonnances')

@section('content')
<div class="mb-4">
    <h6 class="text-muted mb-0">{{ $ordonnances->count() }} ordonnance(s)</h6>
</div>

@forelse($ordonnances as $ordonnance)
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-semibold">
            <i class="bi bi-file-earmark-medical me-2 text-primary"></i>
            Dr. {{ $ordonnance->medecin->nom }} {{ $ordonnance->medecin->prenom }}
        </span>
        <span class="text-muted small">{{ \Carbon\Carbon::parse($ordonnance->date)->format('d/m/Y') }}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="text-muted small mb-1">Médicament(s)</div>
                <p class="mb-0">{{ $ordonnance->medicament }}</p>
            </div>
            <div class="col-md-6 mb-2">
                <div class="text-muted small mb-1">Posologie</div>
                <p class="mb-0">{{ $ordonnance->posologie }}</p>
            </div>
        </div>
    </div>
</div>
@empty
<div class="card">
    <div class="card-body text-center text-muted py-5">
        <i class="bi bi-file-earmark-medical fs-1 d-block mb-3 opacity-25"></i>
        Aucune ordonnance disponible.
    </div>
</div>
@endforelse
@endsection