@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-ticket-alt me-2"></i>Détails du ticket</h4>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="feature-icon">
                            <i class="fas fa-ticket-alt text-primary"></i>
                        </div>
                        <h2>{{ $ticket->nom }}</h2>
                        <h3 class="text-primary fw-bold">{{ number_format($ticket->prix, 0, ',', ' ') }} CFA</h3>
                    </div>
                    
                    @if($ticket->description)
                        <div class="alert alert-light">
                            <h5><i class="fas fa-info-circle me-2"></i>Description</h5>
                            <p class="mb-0">{{ $ticket->description }}</p>
                        </div>
                    @endif
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5><i class="fas fa-calendar-alt me-2"></i>Informations</h5>
                                    <p class="mb-1"><strong>Statut :</strong> 
                                        @if($ticket->actif)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-secondary">Inactif</span>
                                        @endif
                                    </p>
                                    <p class="mb-1"><strong>Créé le :</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="mb-0"><strong>Dernière modification :</strong> {{ $ticket->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5><i class="fas fa-shopping-cart me-2"></i>Action</h5>
                                    <a href="{{ route('tickets.acheter', $ticket) }}" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-shopping-cart me-1"></i>Acheter ce ticket
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        @can('update', $ticket)
                        <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </a>
                        @endcan
                        
                        @can('delete', $ticket)
                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-1"></i>Supprimer
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection