@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-plus-circle me-2"></i>Ajouter un nouveau menu</h1>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Détails du menu</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Erreurs de validation :</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="nom" class="form-label"><i class="fas fa-heading me-1"></i> Nom du menu :</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required placeholder="Ex: Menu Brunch du Dimanche">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description" class="form-label"><i class="fas fa-align-left me-1"></i> Description :</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Décrivez brièvement ce menu...">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date_menu" class="form-label"><i class="fas fa-calendar me-1"></i> Date du menu :</label>
                                    <input type="date" name="date_menu" id="date_menu" class="form-control" value="{{ old('date_menu') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="prix" class="form-label"><i class="fas fa-euro-sign me-1"></i> Prix (FCFA) :</label>
                                    <input type="number" step="0.01" name="prix" id="prix" class="form-control" value="{{ old('prix') }}" required placeholder="Ex: 25.50">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="type" class="form-label"><i class="fas fa-tag me-1"></i> Type :</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">Sélectionnez un type</option>
                                <option value="brunch" {{ old('type') == 'brunch' ? 'selected' : '' }}>Brunch</option>
                                <option value="dejeuner" {{ old('type') == 'dejeuner' ? 'selected' : '' }}>Déjeuner</option>
                                <option value="diner" {{ old('type') == 'diner' ? 'selected' : '' }}>Dîner</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="image" class="form-label"><i class="fas fa-image me-1"></i> Image du menu (optionnel) :</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <div class="form-text">Formats acceptés : JPG, PNG, GIF. Taille maximale : 2MB</div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('menus.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Créer le menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow sticky-top" style="top: 20px;">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Conseils</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Choisissez un nom attractif pour le menu</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Décrivez clairement les plats inclus</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Fixez un prix compétitif</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Sélectionnez le bon type de service</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Planifiez à l'avance les dates de service</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Ajoutez une image attrayante pour attirer les clients</li>
                    </ul>
                    <div class="text-center mt-4">
                        <i class="fas fa-clipboard-list fa-3x text-primary"></i>
                        <p class="mt-2 mb-0">Menu parfait !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection             <p class="mt-2 mb-0">Menu parfait !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection