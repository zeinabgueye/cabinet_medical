@extends('layouts.app')
@section('title', 'Rendez-vous')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="text-muted mb-0">{{ $rendezvous->count() }} rendez-vous</h6>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Date & Heure</th>
                    <th>Motif</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rendezvous as $rdv)
                <tr>
                    <td class="fw-semibold">{{ $rdv->patient->Nom }} {{ $rdv->patient->Prenom }}</td>
                    <td>{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y H:i') }}</td>
                    <td>{{ $rdv->motif }}</td>
                    <td>
                        <span class="badge bg-{{
                            $rdv->statut === 'confirme'   ? 'success' :
                            ($rdv->statut === 'annule'    ? 'danger'  : 'warning') }}">
                            {{ $rdv->statut }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('rendezvous.show', $rdv->id) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('rendezvous.delete', $rdv->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce rendez-vous ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Aucun rendez-vous.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection