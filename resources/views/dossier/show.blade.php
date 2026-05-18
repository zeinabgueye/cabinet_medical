@extends('layouts.app')
@section('title', 'Dossier médical')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-folder2-open me-2"></i> Dossier médical</span>
                <span class="small opacity-75">
                    {{ $dossier->patient->nom }} {{ $dossier->patient->prenom }}
                </span>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Antécédents</h6>
                    <p class="mb-0 p-3 bg-light rounded">{{ $dossier->antecedents }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Traitement en cours</h6>
                    <p class="mb-0 p-3 bg-light rounded">{{ $dossier->traitement_en_cours }}</p>
                </div>

                {{-- Ordonnances liées --}}
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Ordonnances du patient</h6>
                    @forelse($dossier->patient->ordonnances as $ord)
                    <div class="d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                        <span>{{ \Carbon\Carbon::parse($ord->date)->format('d/m/Y') }} — {{ \Str::limit($ord->medicament, 40) }}</span>
                        <a href="{{ route('ordonnance.show', $ord->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                    @empty
                    <p class="text-muted small">Aucune ordonnance.</p>
                    @endforelse
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('dossier.edit', $dossier->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-1"></i> Modifier
                    </a>
                    <a href="{{ route('patient.show', $dossier->patient->id) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-person me-1"></i> Voir le patient
                    </a>
                    <a href="{{ route('dossier.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection