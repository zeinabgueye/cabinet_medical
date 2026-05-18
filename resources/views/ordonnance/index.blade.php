@extends('layouts.app')
@section('title', 'Ordonnances')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="text-muted mb-0">{{ $ordonnances->count() }} ordonnance(s)</h6>
    <a href="{{ route('ordonnance.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus me-1"></i> Nouvelle ordonnance
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Patient</th>
                    <th>Médicament</th>
                    <th>Posologie</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordonnances as $ordonnance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($ordonnance->date)->format('d/m/Y') }}</td>
                    <td class="fw-semibold">{{ $ordonnance->patient->nom }} {{ $ordonnance->patient->prenom }}</td>
                    <td>{{ \Str::limit($ordonnance->medicament, 40) }}</td>
                    <td>{{ \Str::limit($ordonnance->posologie, 40) }}</td>
                    <td class="text-end">
                        <a href="{{ route('ordonnance.show', $ordonnance->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Aucune ordonnance.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection