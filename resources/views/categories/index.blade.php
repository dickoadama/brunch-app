@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-tags me-2"></i>Liste des Catégories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i>Ajouter une nouvelle catégorie
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInRight">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Catégories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Catégories Utilisées</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->where('menus_count', '>', 0)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Menus Totaux</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->sum('menus_count') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-utensils fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Catégories Enregistrées</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Actions:</div>
                    <a class="dropdown-item" href="{{ route('categories.create') }}">Ajouter Catégorie</a>
                    <a class="dropdown-item" href="#">Exporter</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Trier par Nom</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Menus</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $categorie)
                            <tr class="animate__animated animate__fadeInUp">
                                <td>
                                    <i class="fas fa-tag text-primary me-2"></i>
                                    <strong>{{ $categorie->nom }}</strong>
                                </td>
                                <td>{{ $categorie->description ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $categorie->menus_count }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categories.show', $categorie->id) }}" class="btn btn-info btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                    <p class="mb-0">Aucune catégorie trouvée.</p>
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-1"></i>Créer votre première catégorie
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection