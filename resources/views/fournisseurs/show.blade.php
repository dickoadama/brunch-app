@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-truck me-2"></i>Détails du Fournisseur</h1>
        <div>
            <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations du Fournisseur</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-hashtag me-2"></i>ID :</strong> {{ $fournisseur->id }}</p>
                            <p><strong><i class="fas fa-building me-2"></i>Nom :</strong> {{ $fournisseur->nom }}</p>
                            @if($fournisseur->email)
                            <p><strong><i class="fas fa-envelope me-2"></i>Email :</strong> 
                                <a href="mailto:{{ $fournisseur->email }}" class="text-decoration-none">
                                    {{ $fournisseur->email }}
                                </a>
                            </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($fournisseur->telephone)
                            <p><strong><i class="fas fa-phone me-2"></i>Téléphone :</strong> 
                                <a href="tel:{{ $fournisseur->telephone }}" class="text-decoration-none">
                                    {{ $fournisseur->telephone }}
                                </a>
                            </p>
                            @endif
                            <p><strong><i class="fas fa-toggle-on me-2"></i>Statut :</strong> 
                                @if($fournisseur->actif)
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-secondary">Inactif</span>
                                @endif
                            </p>
                            <p><strong><i class="fas fa-clock me-2"></i>Créé le :</strong> {{ $fournisseur->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($fournisseur->adresse)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-map-marker-alt me-2"></i>Adresse :</strong></p>
                        <div class="alert alert-info">
                            {{ $fournisseur->adresse }}
                        </div>
                    </div>
                    @endif
                    
                    @if($fournisseur->notes)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-sticky-note me-2"></i>Notes :</strong></p>
                        <div class="alert alert-warning">
                            {{ $fournisseur->notes }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-carrot me-2"></i>Ingrédients fournis</h5>
                    <span class="badge bg-light text-dark">{{ $fournisseur->ingredients_count }}</span>
                </div>
                <div class="card-body">
                    @if($fournisseur->ingredients_count > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fournisseur->ingredients as $ingredient)
                                        <tr>
                                            <td>
                                                <i class="fas fa-leaf text-primary me-2"></i>
                                                {{ $ingredient->nom }}
                                            </td>
                                            <td>
                                                @if($ingredient->stock_actuel <= $ingredient->seuil_alerte)
                                                    <span class="text-danger fw-bold">{{ $ingredient->stock_actuel }} {{ $ingredient->unite_mesure }}</span>
                                                @else
                                                    <span class="text-success">{{ $ingredient->stock_actuel }} {{ $ingredient->unite_mesure }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('ingredients.show', $ingredient->id) }}" class="btn btn-info btn-sm" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                            <p class="mb-0">Aucun ingrédient fourni par ce fournisseur.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Statistiques</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-carrot fa-3x text-primary mb-2"></i>
                        <h6>Ingrédients Fournis</h6>
                        <p class="mb-0">{{ $fournisseur->ingredients_count }} ingrédients</p>
                    </div>
                    <hr>
                    <div>
                        <i class="fas fa-toggle-on fa-3x text-success mb-2"></i>
                        <h6>Statut</h6>
                        <p class="mb-0">
                            @if($fournisseur->actif)
                                <span class="badge bg-success">Actif</span>
                            @else
                                <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Actions</h5>
                </div>
                <div class="card-body text-center">
                    <p class="mb-3">Souhaitez-vous supprimer ce fournisseur ?</p>
                    <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection