@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-user-tie me-2"></i>Détails de l'Employé</h1>
        <div>
            <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('employes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de l'Employé</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-hashtag me-2"></i>ID :</strong> {{ $employe->id }}</p>
                            <p><strong><i class="fas fa-user me-2"></i>Nom complet :</strong> {{ $employe->nom }} {{ $employe->prenom }}</p>
                            @if($employe->email)
                            <p><strong><i class="fas fa-envelope me-2"></i>Email :</strong> 
                                <a href="mailto:{{ $employe->email }}" class="text-decoration-none">
                                    {{ $employe->email }}
                                </a>
                            </p>
                            @endif
                            <p><strong><i class="fas fa-briefcase me-2"></i>Poste :</strong> {{ $employe->poste }}</p>
                        </div>
                        <div class="col-md-6">
                            @if($employe->telephone)
                            <p><strong><i class="fas fa-phone me-2"></i>Téléphone :</strong> 
                                <a href="tel:{{ $employe->telephone }}" class="text-decoration-none">
                                    {{ $employe->telephone }}
                                </a>
                            </p>
                            @endif
                            <p><strong><i class="fas fa-calendar-day me-2"></i>Date d'embauche :</strong> {{ $employe->date_embauche->format('d/m/Y') }}</p>
                            <p><strong><i class="fas fa-toggle-on me-2"></i>Statut :</strong> 
                                @if($employe->actif)
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-secondary">Inactif</span>
                                @endif
                            </p>
                            <p><strong><i class="fas fa-clock me-2"></i>Créé le :</strong> {{ $employe->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($employe->adresse)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-map-marker-alt me-2"></i>Adresse :</strong></p>
                        <div class="alert alert-info">
                            {{ $employe->adresse }}
                        </div>
                    </div>
                    @endif
                    
                    @if($employe->notes)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-sticky-note me-2"></i>Notes :</strong></p>
                        <div class="alert alert-warning">
                            {{ $employe->notes }}
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
                        <i class="fas fa-briefcase fa-3x text-primary mb-2"></i>
                        <h6>Poste</h6>
                        <p class="mb-0">{{ $employe->poste }}</p>
                    </div>
                    <hr>
                    <div>
                        <i class="fas fa-calendar-day fa-3x text-success mb-2"></i>
                        <h6>Ancienneté</h6>
                        <p class="mb-0">{{ $employe->date_embauche->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Actions</h5>
                </div>
                <div class="card-body text-center">
                    <p class="mb-3">Souhaitez-vous supprimer cet employé ?</p>
                    <form action="{{ route('employes.destroy', $employe->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection