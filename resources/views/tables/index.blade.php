@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-chair me-2"></i>Liste des Tables</h1>
        <a href="{{ route('tables.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i>Ajouter une nouvelle table
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Tables</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tables->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chair fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disponibles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tables->where('disponible', true)->count() }}</div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Capacité Totale</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tables->sum('capacite') }} personnes</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tables Enregistrées</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Actions:</div>
                    <a class="dropdown-item" href="{{ route('tables.create') }}">Ajouter Table</a>
                    <a class="dropdown-item" href="#">Exporter</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Trier par Numéro</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Numéro</th>
                            <th>Capacité</th>
                            <th>Emplacement</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tables as $table)
                            <tr class="animate__animated animate__fadeInUp">
                                <td>
                                    <i class="fas fa-chair text-primary me-2"></i>
                                    <strong>Table #{{ $table->numero }}</strong>
                                </td>
                                <td>{{ $table->capacite }} personnes</td>
                                <td>{{ $table->emplacement ?? 'N/A' }}</td>
                                <td>
                                    @if($table->statut == 'disponible')
                                        <span class="badge bg-success">Disponible</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($table->statut) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('tables.show', $table->id) }}" class="btn btn-info btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tables.destroy', $table->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette table?')" title="Supprimer">
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
                                    <p class="mb-0">Aucune table trouvée.</p>
                                    <a href="{{ route('tables.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-1"></i>Créer votre première table
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