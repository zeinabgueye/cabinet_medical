@extends('layouts.app')
@section('title', 'Détail rendez-vous')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-calendar-check me-2"></i> Rendez-vous</span>
                <span class="badge bg-{{
                    $rendezvous->statut === 'confirme' ? 'success' :
                    ($rendezvous->statut === 'annule'  ? 'danger'  : 'warning') }}">
                    {{ $rendezvous->statut }}
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-4 text-muted">Patient</div>
                    <div class="col-8 fw-semibold">
                        <a href="{{ route('patient.show', $rendezvous->patient->id) }}">
                            {{ $rendezvous->patient->Nom }} {{ $rendezvous->patient->Prenom }}
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-muted">Date & Heure</div>
                    <div class="col-8">{{ \Carbon\Carbon::parse($rendezvous->date_heure)->format('d/m/Y à H:i') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-muted">Motif</div>
                    <div class="col-8">{{ $rendezvous->motif }}</div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('rendezvous.edit', $rendezvous->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-1"></i> Modifier
                    </a>
                    <form action="{{ route('rendezvous.delete', $rendezvous->id) }}" method="POST"
                          onsubmit="return confirm('Supprimer ce rendez-vous ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-trash me-1"></i> Supprimer
                        </button>
                    </form>
                    <a href="{{ route('rendezvous.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection