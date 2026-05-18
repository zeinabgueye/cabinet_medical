@extends('layouts.app')
@section('title', 'Mon espace')

@section('content')
<div class="row g-4">

    {{-- Carte de bienvenue --}}
    <div class="col-12">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="mb-1">Bonjour, {{ $patient->nom }} {{ $patient->prenom }} </h5>
                <p class="mb-0 small opacity-75">Bienvenue dans votre espace patient.</p>
            </div>
        </div>
    </div>

    {{-- Mes prochains RDV --}}
    <div class="col-md-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-calendar-check me-2"></i> Mes prochains rendez-vous</span>
                <a href="{{ route('patient.rendezvous.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus me-1"></i> Nouveau RDV
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr><th>Date</th><th>Motif</th><th>Statut</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse($patient->rendezvous()->orderBy('date_heure')->get() as $rdv)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y H:i') }}</td>
                            <td>{{ $rdv->motif }}</td>
                            <td>
                                <span class="badge bg-{{
                                    $rdv->statut === 'confirme' ? 'success' :
                                    ($rdv->statut === 'annule' ? 'danger' : 'warning') }}">
                                    {{ $rdv->statut }}
                                </span>
                            </td>
                            <td>
                                @if($rdv->statut === 'en_attente')
                                <form action="{{ route('patient.rendezvous.delete', $rdv->id) }}" method="POST"
                                      onsubmit="return confirm('Annuler ce rendez-vous ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Aucun rendez-vous.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Liens rapides --}}
    <div class="col-md-5">
        <div class="card mb-3">
            <div class="card-header"><i class="bi bi-folder2-open me-2"></i> Mon dossier médical</div>
            <div class="card-body">
                <p class="text-muted small">Consultez vos antécédents et traitements en cours.</p>
                <a href="{{ route('patient.dossier') }}" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-eye me-1"></i> Voir mon dossier
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><i class="bi bi-file-earmark-medical me-2"></i> Mes ordonnances</div>
            <div class="card-body">
                <p class="text-muted small">Retrouvez toutes vos ordonnances.</p>
                <a href="{{ route('patient.ordonnance') }}" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-eye me-1"></i> Voir mes ordonnances
                </a>
            </div>
        </div>
    </div>

</div>
@endsection