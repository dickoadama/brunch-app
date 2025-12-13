@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-truck-loading me-2"></i>Ajouter un nouveau fournisseur</h4>
                    <a href="{{ route('fournisseurs.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger animate__animated animate__shakeX">
                            <i class="fas fa-exclamation-triangle me-2"></i>Veuillez corriger les erreurs ci-dessous :
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('fournisseurs.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nom" class="form-label">
                                <i class="fas fa-building me-1"></i>Nom du fournisseur
                            </label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-1"></i>Email (optionnel)
                                    </label>
                                    <input type="email" name="email" id="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telephone" class="form-label">
                                        <i class="fas fa-phone me-1"></i>Téléphone (optionnel)
                                    </label>
                                    <input type="text" name="telephone" id="telephone" 
                                           class="form-control @error('telephone') is-invalid @enderror" 
                                           value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="adresse" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Adresse (optionnel)
                            </label>
                            <textarea name="adresse" id="adresse" rows="2" 
                                      class="form-control @error('adresse') is-invalid @enderror">{{ old('adresse') }}</textarea>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="notes" class="form-label">
                                <i class="fas fa-sticky-note me-1"></i>Notes (optionnel)
                            </label>
                            <textarea name="notes" id="notes" rows="3" 
                                      class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-check mb-3">
                            <input type="checkbox" name="actif" id="actif" class="form-check-input" 
                                   {{ old('actif', true) ? 'checked' : '' }}>
                            <label for="actif" class="form-check-label">
                                <i class="fas fa-toggle-on me-1"></i>Fournisseur actif
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Enregistrer le fournisseur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4 border-left-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">
                        <i class="fas fa-lightbulb me-2"></i>Conseils pour les fournisseurs
                    </h5>
                    <ul class="mb-0">
                        <li>Vérifiez les coordonnées du fournisseur avant de l'enregistrer</li>
                        <li>Notez les conditions de livraison et les délais</li>
                        <li>Indiquez les produits principaux fournis</li>
                        <li>Mettez à jour régulièrement les informations de contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection