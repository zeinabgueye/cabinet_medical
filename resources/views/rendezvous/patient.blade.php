@extends('layouts.app')
@section('title', 'Mes rendez-vous')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="text-muted mb-0">{{ $rendezvous->count() }} rendez-vous</h6>
    <a href="{{ route('patient.rendezvous.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus me-1"></i> Nouveau RDV
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date & Heure</th>
                    <th>Motif</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rendezvous as $rdv)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y H:i') }}</td>
                    <td>{{ $rdv->motif }}</td>
                    <td>
                        <span class="badge bg-{{
                            $rdv->statut === 'confirme' ? 'success' :
                            ($rdv->statut === 'annule'  ? 'danger'  : 'warning') }}">
                            {{ $rdv->statut }}
                        </span>
                    </td>
                    <td class="text-end">
                        @if($rdv->statut === 'en_attente')
                        <form action="{{ route('patient.rendezvous.delete', $rdv->id) }}" method="POST"
                              onsubmit="return confirm('Annuler ce rendez-vous ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-x-circle me-1"></i> Annuler
                            </button>
                        </form>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Aucun rendez-vous.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection