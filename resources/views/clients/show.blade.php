@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-user me-2"></i>{{ $client->prenom }} {{ $client->nom }}</h1>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-address-card me-2"></i>Informations Personnelles</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="mt-3">
                            <h4>{{ $client->prenom }} {{ $client->nom }}</h4>
                            <p class="text-muted mb-1">Client depuis {{ $client->created_at->format('d/m/Y') }}</p>
                            <p class="text-muted mb-1">ID: {{ $client->id }}</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-envelope me-2 text-primary"></i>Email</span>
                            <a href="mailto:{{ $client->email }}" class="text-decoration-none">{{ $client->email }}</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-phone me-2 text-success"></i>Téléphone</span>
                            @if($client->telephone)
                                <a href="tel:{{ $client->telephone }}" class="text-decoration-none">{{ $client->telephone }}</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-birthday-cake me-2 text-warning"></i>Date de naissance</span>
                            <span>{{ $client->date_naissance ? $client->date_naissance->format('d/m/Y') : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-map-marker-alt me-2 text-danger"></i>Adresse</span>
                            <span>{{ $client->adresse ?? 'N/A' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Réservations</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $client->reservations->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Commandes</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $client->commandes->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Montant Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($client->commandes->sum('montant_total'), 2, ',', ' ') }} FCFA</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Dernière Activité</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if($client->reservations->last())
                                            {{ $client->reservations->last()->date_reservation->format('d/m/Y') }}
                                        @elseif($client->commandes->last())
                                            {{ $client->commandes->last()->date_commande->format('d/m/Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-history fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Historique des réservations</h5>
                    <span class="badge bg-light text-dark">{{ $client->reservations->count() }}</span>
                </div>
                <div class="card-body">
                    @if($client->reservations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Personnes</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($client->reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->date_reservation->format('d/m/Y H:i') }}</td>
                                            <td>{{ $reservation->nombre_personnes }}</td>
                                            <td>
                                                @if($reservation->statut == 'confirmée')
                                                    <span class="badge bg-success">Confirmée</span>
                                                @elseif($reservation->statut == 'en attente')
                                                    <span class="badge bg-warning text-dark">En attente</span>
                                                @elseif($reservation->statut == 'annulée')
                                                    <span class="badge bg-danger">Annulée</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $reservation->statut }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                            <p class="mb-0">Aucune réservation pour ce client.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Historique des commandes</h5>
                    <span class="badge bg-light text-dark">{{ $client->commandes->count() }}</span>
                </div>
                <div class="card-body">
                    @if($client->commandes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Menu</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($client->commandes as $commande)
                                        <tr>
                                            <td>{{ $commande->date_commande->format('d/m/Y H:i') }}</td>
                                            <td>{{ $commande->menu->nom }}</td>
                                            <td>{{ number_format($commande->montant_total, 2, ',', ' ') }} FCFA</td>
                                            <td>
                                                @if($commande->statut == 'confirmée')
                                                    <span class="badge bg-success">Confirmée</span>
                                                @elseif($commande->statut == 'en attente')
                                                    <span class="badge bg-warning text-dark">En attente</span>
                                                @elseif($commande->statut == 'annulée')
                                                    <span class="badge bg-danger">Annulée</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $commande->statut }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                            <p class="mb-0">Aucune commande pour ce client.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Modifier
                    </a>
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                    </a>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection