@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-clipboard-list me-2"></i>Liste des Menus</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i>Ajouter un nouveau menu
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Menus</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $menus->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Brunchs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $menus->where('type', 'brunch')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coffee fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Menus Disponibles</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Actions:</div>
                    <a class="dropdown-item" href="{{ route('menus.create') }}">Ajouter Menu</a>
                    <a class="dropdown-item" href="#">Exporter</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Trier par Date</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Prix</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                            <tr class="animate__animated animate__fadeInUp">
                                <td>
                                    <i class="fas fa-clipboard-list text-primary me-2"></i>
                                    <strong>{{ $menu->nom }}</strong>
                                </td>
                                <td>
                                    @if($menu->type == 'brunch')
                                        <span class="badge bg-warning text-dark">Brunch</span>
                                    @elseif($menu->type == 'dejeuner')
                                        <span class="badge bg-success">Déjeuner</span>
                                    @elseif($menu->type == 'diner')
                                        <span class="badge bg-info">Dîner</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($menu->type) }}</span>
                                    @endif
                                </td>
                                <td>{{ $menu->date_menu->format('d/m/Y') }}</td>
                                <td>
                                    <span class="text-success fw-bold">{{ number_format($menu->prix, 2, ',', ' ') }} FCFA</span>
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-info btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu?')" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                    <p class="mb-0">Aucun menu trouvé.</p>
                                    <a href="{{ route('menus.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-1"></i>Créer votre premier menu
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