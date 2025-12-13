@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-tags me-2"></i>Ajouter une nouvelle catégorie</h4>
                    <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm">
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
                    
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nom" class="form-label">
                                <i class="fas fa-tag me-1"></i>Nom de la catégorie
                            </label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>Description (optionnel)
                            </label>
                            <textarea name="description" id="description" rows="3" 
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Enregistrer la catégorie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4 border-left-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">
                        <i class="fas fa-lightbulb me-2"></i>Conseils pour les catégories
                    </h5>
                    <ul class="mb-0">
                        <li>Utilisez des noms de catégories clairs et concis</li>
                        <li>Ajoutez une description pour expliquer le contenu de la catégorie</li>
                        <li>Évitez les catégories trop similaires pour faciliter la navigation</li>
                        <li>Pensez à l'organisation globale de vos recettes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection