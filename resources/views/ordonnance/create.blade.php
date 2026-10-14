use App\Models\Patient;
@extends('layouts.app')
@section('title', 'Nouvelle ordonnance')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-file-earmark-plus me-2"></i> Nouvelle ordonnance
            </div>
            <div class="card-body p-4">
                <form action="{{ route('ordonnance.save') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Patient</label>
                        <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
                            <option value="">-- Choisir un patient --</option>
                            @foreach(\App\Models\Patient::all() as $patient)
                            <option value="{{ $patient->id }}"
                                {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->nom }} {{ $patient->prenom }}
                            </option>
                            @endforeach
                        </select>
                        @error('patient_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('date', now()->format('Y-m-d')) }}" required>
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Médicament(s)</label>
                        <textarea name="medicament" rows="3"
                                  class="form-control @error('medicament') is-invalid @enderror"
                                  placeholder="Nom du médicament, dosage..." required>{{ old('medicament') }}</textarea>
                        @error('medicament') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Posologie</label>
                        <textarea name="posologie" rows="3"
                                  class="form-control @error('posologie') is-invalid @enderror"
                                  placeholder="Ex: 1 comprimé matin et soir pendant 7 jours..." required>{{ old('posologie') }}</textarea>
                        @error('posologie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Enregistrer
                        </button>
                        <a href="{{ route('ordonnance.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection