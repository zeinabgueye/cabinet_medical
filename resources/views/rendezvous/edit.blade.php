@extends('layouts.app')
@section('title', 'Modifier rendez-vous')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-pencil me-2"></i> Modifier le rendez-vous
            </div>
            <div class="card-body p-4">
                <form action="{{ route('rendezvous.update', $rendezvous->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Date & Heure</label>
                        <input type="datetime-local" name="date_heure"
                               class="form-control @error('date_heure') is-invalid @enderror"
                               value="{{ old('date_heure', \Carbon\Carbon::parse($rendezvous->date_heure)->format('Y-m-d\TH:i')) }}">
                        @error('date_heure') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Motif</label>
                        <textarea name="motif" rows="3"
                                  class="form-control @error('motif') is-invalid @enderror">{{ old('motif', $rendezvous->motif) }}</textarea>
                        @error('motif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                            <option value="en_attente" {{ old('statut', $rendezvous->statut) === 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="confirme"   {{ old('statut', $rendezvous->statut) === 'confirme'   ? 'selected' : '' }}>Confirmé</option>
                            <option value="annule"     {{ old('statut', $rendezvous->statut) === 'annule'     ? 'selected' : '' }}>Annulé</option>
                        </select>
                        @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Sauvegarder
                        </button>
                        <a href="{{ route('rendezvous.show', $rendezvous->id) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection