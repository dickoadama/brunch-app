@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier la table</h4>
                    <a href="{{ route('tables.index') }}" class="btn btn-light btn-sm">
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
                    
                    <form action="{{ route('tables.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numero" class="form-label">
                                        <i class="fas fa-hashtag me-1"></i>Numéro de la table
                                    </label>
                                    <input type="number" name="numero" id="numero" 
                                           class="form-control @error('numero') is-invalid @enderror" 
                                           value="{{ old('numero', $table->numero) }}" min="1" required>
                                    @error('numero')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="capacite" class="form-label">
                                        <i class="fas fa-users me-1"></i>Capacité (personnes)
                                    </label>
                                    <input type="number" name="capacite" id="capacite" 
                                           class="form-control @error('capacite') is-invalid @enderror" 
                                           value="{{ old('capacite', $table->capacite) }}" min="1" max="20" required>
                                    @error('capacite')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="emplacement" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Emplacement (optionnel)
                            </label>
                            <input type="text" name="emplacement" id="emplacement" 
                                   class="form-control @error('emplacement') is-invalid @enderror" 
                                   value="{{ old('emplacement', $table->emplacement) }}">
                            @error('emplacement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>Description (optionnel)
                            </label>
                            <textarea name="description" id="description" rows="3" 
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $table->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">
                                <i class="fas fa-image me-1"></i>Image de la table (optionnel)
                            </label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <div class="form-text">Formats acceptés : JPG, PNG, GIF. Taille maximale : 2MB</div>
                            
                            @if($table->image_path)
                                <div class="mt-2">
                                    <label class="form-label">Image actuelle :</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $table->image_path) }}" alt="Image de la table" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-check mb-3">
                            <input type="checkbox" name="disponible" id="disponible" class="form-check-input" 
                                   {{ old('disponible', $table->disponible) ? 'checked' : '' }}>
                            <label for="disponible" class="form-check-label">
                                <i class="fas fa-toggle-on me-1"></i>Table disponible
                            </label>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('tables.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Mettre à jour la table
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4 border-left-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">
                        <i class="fas fa-lightbulb me-2"></i>Conseils pour les tables
                    </h5>
                    <ul class="mb-0">
                        <li>Attribuez des numéros uniques à chaque table</li>
                        <li>Indiquez la capacité réelle de chaque table</li>
                        <li>Précisez l'emplacement pour faciliter la navigation</li>
                        <li>Mettez à jour le statut de disponibilité en temps réel</li>
                        <li>Ajoutez une image pour montrer l'aspect de la table</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection