@extends('layouts.app')
@section('title', 'Fiche patient')

@section('content')
<div class="row g-4">

    {{-- Infos patient --}}
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-person me-2"></i> {{ $patient->nom }} {{ $patient->prenom }}
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-5 text-muted">Téléphone</div>
                    <div class="col-7">{{ $patient->telephone }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5 text-muted">Adresse</div>
                    <div class="col-7">{{ $patient->adresse }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-5 text-muted">État</div>
                    <div class="col-7">
                        <span class="badge bg-{{ $patient->etat === 'actif' ? 'success' : 'secondary' }}">
                            {{ $patient->etat }}
                        </span>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i> Modifier
                    </a>
                    <a href="{{ route('dossier.create', $patient->id) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-folder-plus me-1"></i> Créer dossier
                    </a>
                    <a href="{{ route('rendezvous.create', $patient->id) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-calendar-plus me-1"></i> Nouveau RDV
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Derniers rendez-vous --}}
    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-calendar-check me-2"></i> Derniers rendez-vous
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr><th>Date</th><th>Motif</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        @forelse($patient->rendezvous as $rdv)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y H:i') }}</td>
                            <td>{{ $rdv->motif }}</td>
                            <td>
                                <span class="badge bg-{{
                                    $rdv->statut === 'confirme'?'success' :
                                    ($rdv->statut === 'annule' ?'danger' : 'warning') }}">
                                    {{ $rdv->statut }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Aucun rendez-vous.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Dossier médical --}}
        <div class="card">
            <div class="card-header">
                <i class="bi bi-folder2-open me-2"></i> Dossier médical
            </div>
            <div class="card-body">
                @if($patient->dossier)
                <div class="mb-2">
                    <span class="text-muted small">Antécédents</span>
                    <p class="mb-0">{{ $patient->dossier->antecedents }}</p>
                </div>
                <div class="mb-2">
                    <span class="text-muted small">Traitement en cours</span>
                    <p class="mb-0">{{ $patient->dossier->traitement_en_cours }}</p>
                </div>
                <a href="{{ route('dossier.edit', $patient->dossier->id) }}" class="btn btn-outline-primary btn-sm mt-2">
                    <i class="bi bi-pencil me-1"></i> Modifier le dossier
                </a>
                @else
                <p class="text-muted">Aucun dossier médical.</p>
                <a href="{{ route('dossier.create', $patient->id) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-folder-plus me-1"></i> Créer le dossier
                </a>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection