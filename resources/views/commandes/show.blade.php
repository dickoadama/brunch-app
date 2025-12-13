@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-shopping-cart me-2"></i>Détails de la Commande</h1>
        <div>
            <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de la Commande</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-hashtag me-2"></i>ID :</strong> {{ $commande->id }}</p>
                            <p><strong><i class="fas fa-user me-2"></i>Client :</strong> 
                                <a href="{{ route('clients.show', $commande->client->id) }}" class="text-decoration-none">
                                    {{ $commande->client->nom }} {{ $commande->client->prenom }}
                                </a>
                            </p>
                            <p><strong><i class="fas fa-clipboard-list me-2"></i>Menu :</strong> {{ $commande->menu->nom ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-calendar-day me-2"></i>Date de commande :</strong> {{ $commande->date_commande->format('d/m/Y H:i') }}</p>
                            <p><strong><i class="fas fa-sort-numeric-up me-2"></i>Quantité :</strong> {{ $commande->quantite }}</p>
                            <p><strong><i class="fas fa-euro-sign me-2"></i>Montant Total :</strong> 
                                <span class="text-success fw-bold">{{ number_format($commande->montant_total, 2, ',', ' ') }} FCFA</span>
                            </p>
                            <p><strong><i class="fas fa-info-circle me-2"></i>Statut :</strong> 
                                @if($commande->statut == 'confirmée')
                                    <span class="badge bg-success">Confirmée</span>
                                @elseif($commande->statut == 'en attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($commande->statut == 'annulée')
                                    <span class="badge bg-danger">Annulée</span>
                                @else
                                    <span class="badge bg-secondary">{{ $commande->statut }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    @if($commande->notes)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-sticky-note me-2"></i>Notes :</strong></p>
                        <div class="alert alert-info">
                            {{ $commande->notes }}
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
                        <i class="fas fa-euro-sign fa-3x text-success mb-2"></i>
                        <h6>Montant de la commande</h6>
                        <p class="mb-0 text-success fw-bold">{{ number_format($commande->montant_total, 2, ',', ' ') }} FCFA</p>
                    </div>
                    <hr>
                    <div>
                        <i class="fas fa-box fa-3x text-primary mb-2"></i>
                        <h6>Quantité</h6>
                        <p class="mb-0">{{ $commande->quantite }} unités</p>
                    </div>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Actions</h5>
                </div>
                <div class="card-body text-center">
                    @if($commande->statut != 'confirmée')
                        <a href="{{ route('commandes.payer', $commande->id) }}" class="btn btn-success mb-3">
                            <i class="fas fa-credit-card me-1"></i>Procéder au Paiement
                        </a>
                        <hr>
                    @endif
                    <p class="mb-3">Souhaitez-vous supprimer cette commande ?</p>
                    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection