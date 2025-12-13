@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-tags me-2"></i>Détails de la Catégorie</h1>
        <div>
            <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de la Catégorie</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-hashtag me-2"></i>ID :</strong> {{ $categorie->id }}</p>
                            <p><strong><i class="fas fa-tag me-2"></i>Nom :</strong> {{ $categorie->nom }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-utensils me-2"></i>Menus associés :</strong> 
                                <span class="badge bg-primary">{{ $categorie->menus_count }}</span>
                            </p>
                            <p><strong><i class="fas fa-clock me-2"></i>Créée le :</strong> {{ $categorie->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($categorie->description)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-align-left me-2"></i>Description :</strong></p>
                        <div class="alert alert-info">
                            {{ $categorie->description }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-book me-2"></i>Menus dans cette catégorie</h5>
                    <span class="badge bg-light text-dark">{{ $categorie->menus_count }}</span>
                </div>
                <div class="card-body">
                    @if($categorie->menus_count > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prix</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categorie->menus as $menu)
                                        <tr>
                                            <td>
                                                <i class="fas fa-utensils text-primary me-2"></i>
                                                {{ $menu->nom }}
                                            </td>
                                            <td>
                                                @if($menu->prix)
                                                    <span class="text-success fw-bold">{{ number_format($menu->prix, 2, ',', ' ') }} FCFA</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-info btn-sm" title="Voir">
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
                            <p class="mb-0">Aucun menu dans cette catégorie.</p>
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
                        <i class="fas fa-book fa-3x text-primary mb-2"></i>
                        <h6>Menus</h6>
                        <p class="mb-0">{{ $categorie->menus_count }} menus</p>
                    </div>
                    <hr>
                    <div>
                        <i class="fas fa-tag fa-3x text-success mb-2"></i>
                        <h6>Catégorie</h6>
                        <p class="mb-0">{{ $categorie->nom }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Actions</h5>
                </div>
                <div class="card-body text-center">
                    <p class="mb-3">Souhaitez-vous supprimer cette catégorie ?</p>
                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection