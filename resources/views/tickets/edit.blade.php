@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-edit me-2"></i>Modifier le ticket</h4>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="nom" class="form-label">Nom du ticket *</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $ticket->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="prix" class="form-label">Prix (CFA) *</label>
                            <input type="number" class="form-control @error('prix') is-invalid @enderror" 
                                   id="prix" name="prix" value="{{ old('prix', $ticket->prix) }}" min="0" step="500" required>
                            <div class="form-text">Prix en CFA (multiples de 500 recommandés)</div>
                            @error('prix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $ticket->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="actif" name="actif" value="1" 
                                   {{ old('actif', $ticket->actif) ? 'checked' : '' }}>
                            <label class="form-check-label" for="actif">
                                Ticket actif
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5><i class="fas fa-info-circle me-2"></i>Détails du ticket</h5>
                            <p class="mb-1"><strong>Créé le :</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                            <p class="mb-1"><strong>Dernière modification :</strong> {{ $ticket->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        
                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection