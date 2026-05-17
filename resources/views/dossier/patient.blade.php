@extends('layouts.app')
@section('title', 'Mon dossier médical')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-folder2-open me-2"></i> Mon dossier médical
            </div>
            <div class="card-body p-4">
                @if($dossier)
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Antécédents</h6>
                        <p class="mb-0 p-3 bg-light rounded">{{ $dossier->antecedents }}</p>
                    </div>
                    <div class="mb-2">
                        <h6 class="text-muted mb-2">Traitement en cours</h6>
                        <p class="mb-0 p-3 bg-light rounded">{{ $dossier->traitement_en_cours }}</p>
                    </div>
                @else
                    <p class="text-muted text-center py-4">Votre dossier médical n'est pas encore disponible.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection