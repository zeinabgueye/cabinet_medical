@extends('layouts.app')
@section('title', 'Patients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="text-muted mb-0">{{ $patients->count() }} patient(s) enregistré(s)</h6>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nom & Prénom</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>État</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td class="fw-semibold">{{ $patient->Nom }} {{ $patient->Prenom }}</td>
                    <td>{{ $patient->Telephone }}</td>
                    <td>{{ $patient->adresse }}</td>
                    <td>
                        <span class="badge bg-{{ $patient->Etat === 'actif' ? 'success' : 'secondary' }}">
                            {{ $patient->Etat }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('patient.show', $patient->id) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('patient.delete', $patient->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce patient ?')">
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
                    <td colspan="5" class="text-center text-muted py-4">Aucun patient enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection