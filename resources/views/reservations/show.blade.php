@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-calendar-check me-2"></i>Détails de la Réservation</h1>
        <div>
            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations de la Réservation</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-hashtag me-2"></i>ID :</strong> {{ $reservation->id }}</p>
                            <p><strong><i class="fas fa-user me-2"></i>Client :</strong> 
                                <a href="{{ route('clients.show', $reservation->client->id) }}" class="text-decoration-none">
                                    {{ $reservation->client->nom }} {{ $reservation->client->prenom }}
                                </a>
                            </p>
                            <p><strong><i class="fas fa-calendar-day me-2"></i>Date et Heure :</strong> {{ $reservation->date_reservation->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-users me-2"></i>Nombre de Personnes :</strong> {{ $reservation->nombre_personnes }}</p>
                            <p><strong><i class="fas fa-info-circle me-2"></i>Statut :</strong> 
                                @if($reservation->statut == 'confirmée')
                                    <span class="badge bg-success">Confirmée</span>
                                @elseif($reservation->statut == 'en attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($reservation->statut == 'annulée')
                                    <span class="badge bg-danger">Annulée</span>
                                @else
                                    <span class="badge bg-secondary">{{ $reservation->statut }}</span>
                                @endif
                            </p>
                            <p><strong><i class="fas fa-clock me-2"></i>Créée le :</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($reservation->notes)
                    <div class="mt-3">
                        <p><strong><i class="fas fa-sticky-note me-2"></i>Notes :</strong></p>
                        <div class="alert alert-info">
                            {{ $reservation->notes }}
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
                        <i class="fas fa-calendar-check fa-3x text-info mb-2"></i>
                        <h6>Prochaine Réservation</h6>
                        <p class="mb-0">{{ $reservation->date_reservation->format('d/m/Y') }}</p>
                    </div>
                    <hr>
                    <div>
                        <i class="fas fa-user-friends fa-3x text-primary mb-2"></i>
                        <h6>Personnes</h6>
                        <p class="mb-0">{{ $reservation->nombre_personnes }} personnes</p>
                    </div>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Actions</h5>
                </div>
                <div class="card-body text-center">
                    @if($reservation->statut != 'confirmée')
                        <a href="{{ route('reservations.payer', $reservation->id) }}" class="btn btn-success mb-3">
                            <i class="fas fa-credit-card me-1"></i>Procéder au Paiement
                        </a>
                        <hr>
                    @endif
                    <p class="mb-3">Souhaitez-vous supprimer cette réservation ?</p>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection