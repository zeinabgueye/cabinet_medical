@extends('layouts.app')
@section('title', 'Nouveau rendez-vous')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-calendar-plus me-2"></i> Nouveau rendez-vous
            </div>
            <div class="card-body p-4">
                <form action="{{ route('rendezvous.save', $id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Date & Heure</label>
                        <input type="datetime-local" name="date_heure"
                               class="form-control @error('date_heure') is-invalid @enderror"
                               value="{{ old('date_heure') }}">
                        @error('date_heure') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Motif</label>
                        <textarea name="motif" rows="3"
                                  class="form-control @error('motif') is-invalid @enderror">{{ old('motif') }}</textarea>
                        @error('motif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Enregistrer
                        </button>
                        <a href="{{ route('rendezvous.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection