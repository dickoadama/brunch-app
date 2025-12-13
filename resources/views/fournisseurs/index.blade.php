@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-truck me-2"></i>Liste des Fournisseurs</h1>
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i>Ajouter un nouveau fournisseur
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Fournisseurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $fournisseurs->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Actifs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $fournisseurs->where('actif', true)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ingrédients Fournis</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $fournisseurs->sum('ingredients_count') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-carrot fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Fournisseurs Enregistrés</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Actions:</div>
                    <a class="dropdown-item" href="{{ route('fournisseurs.create') }}">Ajouter Fournisseur</a>
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
                            <th>Contact</th>
                            <th>Ingrédients</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fournisseurs as $fournisseur)
                            <tr class="animate__animated animate__fadeInUp">
                                <td>
                                    <i class="fas fa-building text-primary me-2"></i>
                                    <strong>{{ $fournisseur->nom }}</strong>
                                </td>
                                <td>
                                    @if($fournisseur->email)
                                        <a href="mailto:{{ $fournisseur->email }}" class="text-decoration-none">
                                            <i class="fas fa-envelope me-1"></i>{{ $fournisseur->email }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                    @if($fournisseur->telephone)
                                        <br><a href="tel:{{ $fournisseur->telephone }}" class="text-decoration-none">
                                            <i class="fas fa-phone me-1"></i>{{ $fournisseur->telephone }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $fournisseur->ingredients_count }}</span>
                                </td>
                                <td>
                                    @if($fournisseur->actif)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-secondary">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('fournisseurs.show', $fournisseur->id) }}" class="btn btn-info btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur?')" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                    <p class="mb-0">Aucun fournisseur trouvé.</p>
                                    <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-1"></i>Créer votre premier fournisseur
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