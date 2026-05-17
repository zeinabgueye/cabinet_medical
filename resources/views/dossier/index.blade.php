@extends('layouts.app')
@section('title', 'Dossiers médicaux')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="text-muted mb-0">{{ $dossiers->count() }} dossier(s)</h6>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Antécédents</th>
                    <th>Traitement en cours</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dossiers as $dossier)
                <tr>
                    <td class="fw-semibold">{{ $dossier->patient->Nom }} {{ $dossier->patient->Prenom }}</td>
                    <td>{{ \Str::limit($dossier->antecedents, 255) }}</td>
                    <td>{{ \Str::limit($dossier->traitement_en_cours, 255) }}</td>
                    <td class="text-end">
                        <a href="{{ route('dossier.show', $dossier->id) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('dossier.edit', $dossier->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Aucun dossier médical.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection