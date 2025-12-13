@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-chair me-2"></i>Détails de la Table</h1>
        <div>
            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('tables.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de la Table</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-hashtag me-2"></i>Numéro :</strong> #{{ $table->numero }}</p>
                            <p><strong><i class="fas fa-users me-2"></i>Capacité :</strong> {{ $table->capacite }} personnes</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-toggle-on me-2"></i>Statut :</strong> 
                                @if($table->disponible)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-secondary">Occupée</span>
                                @endif
                            </p>
                            <p><strong><i class="fas fa-clock me-2"></i>Créée le :</strong> {{ $table->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($table->emplacement)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-map-marker-alt me-2"></i>Emplacement :</strong></p>
                        <div class="alert alert-info">
                            {{ $table->emplacement }}
                        </div>
                    </div>
                    @endif
                    
                    @if($table->description)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-align-left me-2"></i>Description :</strong></p>
                        <div class="alert alert-warning">
                            {{ $table->description }}
                        </div>
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
                        <i class="fas fa-users fa-3x text-primary mb-2"></i>
                        <h6>Capacité</h6>
                        <p class="mb-0">{{ $table->capacite }} personnes</p>
                    </div>
                    <hr>
                    <div>
                        <i class="fas fa-toggle-on fa-3x text-success mb-2"></i>
                        <h6>Statut</h6>
                        <p class="mb-0">
                            @if($table->disponible)
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-secondary">Occupée</span>
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
                    <p class="mb-3">Souhaitez-vous supprimer cette table ?</p>
                    <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette table?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection