@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-ticket-alt me-2"></i>Créer un nouveau ticket</h4>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="nom" class="form-label">Nom du ticket *</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="prix" class="form-label">Prix (CFA) *</label>
                            <input type="number" class="form-control @error('prix') is-invalid @enderror" 
                                   id="prix" name="prix" value="{{ old('prix') }}" min="0" step="500" required>
                            <div class="form-text">Prix en CFA (multiples de 500 recommandés)</div>
                            @error('prix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="actif" name="actif" value="1" 
                                   {{ old('actif', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="actif">
                                Ticket actif
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-undo me-1"></i>Annuler
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Créer le ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection