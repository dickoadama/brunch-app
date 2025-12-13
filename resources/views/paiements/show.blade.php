@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-receipt me-2"></i>Détails du Paiement</h1>
        <div class="btn-group">
            <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour à la liste
            </a>
            <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>{{ $paiement->reference }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-barcode me-1"></i> Référence :</label>
                                <p class="form-control-plaintext">{{ $paiement->reference }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-euro-sign me-1"></i> Montant :</label>
                                <p class="form-control-plaintext text-success fw-bold fs-5">{{ number_format($paiement->montant, 2, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-credit-card me-1"></i> Méthode de Paiement :</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $paiement->methode)) }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-sync me-1"></i> Statut :</label>
                                <p class="form-control-plaintext">
                                    @if($paiement->statut == 'en_attente')
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif($paiement->statut == 'valide')
                                        <span class="badge bg-success">Validé</span>
                                    @elseif($paiement->statut == 'annule')
                                        <span class="badge bg-danger">Annulé</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-link me-1"></i> Type de Transaction :</label>
                        <p class="form-control-plaintext">
                            @if($paiement->commande_id)
                                <span class="badge bg-primary">Commande #{{ $paiement->commande_id }}</span>
                            @elseif($paiement->reservation_id)
                                <span class="badge bg-info">Réservation #{{ $paiement->reservation_id }}</span>
                            @elseif($paiement->ticket_id)
                                <span class="badge bg-success">Ticket #{{ $paiement->ticket_id }}</span>
                            @else
                                <span class="badge bg-secondary">Aucune transaction associée</span>
                            @endif
                        </p>
                    </div>
                    
                    @if($paiement->qr_code)
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-qrcode me-1"></i> QR Code :</label>
                        <div class="text-center">
                            <div class="border p-3 d-inline-block">
                                <div class="bg-light p-3">
                                    <p class="mb-0">{{ $paiement->qr_code }}</p>
                                </div>
                                <p class="mt-2 mb-0"><small>Code de paiement simulé</small></p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt me-1"></i> Date de Création :</label>
                        <p class="form-control-plaintext">{{ $paiement->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-history me-1"></i> Dernière Mise à Jour :</label>
                        <p class="form-control-plaintext">{{ $paiement->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <hr>
                    
                    <h5><i class="fas fa-receipt me-2"></i>Détails de la Transaction</h5>
                    @if($paiement->commande)
                        <div class="mt-3">
                            <p class="mb-1"><strong>Commande :</strong> #{{ $paiement->commande->id }}</p>
                            <p class="mb-1"><strong>Client :</strong> {{ $paiement->commande->client->nom ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Date :</strong> {{ $paiement->commande->created_at->format('d/m/Y H:i') }}</p>
                            <p class="mb-0"><strong>Total :</strong> {{ number_format($paiement->commande->montant_total ?? 0, 2, ',', ' ') }} FCFA</p>
                        </div>
                    @elseif($paiement->reservation)
                        <div class="mt-3">
                            <p class="mb-1"><strong>Réservation :</strong> #{{ $paiement->reservation->id }}</p>
                            <p class="mb-1"><strong>Client :</strong> {{ $paiement->reservation->client->nom ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Table :</strong> {{ $paiement->reservation->table->numero_table ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Date :</strong> {{ $paiement->reservation->date_reservation->format('d/m/Y H:i') }}</p>
                            <p class="mb-0"><strong>Nombre de personnes :</strong> {{ $paiement->reservation->nombre_personnes }}</p>
                        </div>
                    @elseif($paiement->ticket)
                        <div class="mt-3">
                            <p class="mb-1"><strong>Ticket :</strong> #{{ $paiement->ticket->id }}</p>
                            <p class="mb-1"><strong>Nom :</strong> {{ $paiement->ticket->nom }}</p>
                            <p class="mb-1"><strong>Description :</strong> {{ $paiement->ticket->description ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>Prix :</strong> {{ number_format($paiement->ticket->prix, 2, ',', ' ') }} FCFA</p>
                        </div>
                    @else
                        <div class="mt-3">
                            <p class="mb-0 text-muted">Aucune transaction associée</p>
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
                    <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                    </a>
                    <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Modifier
                    </a>
                    <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement?')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimer
                    </button>
                    @if(!$paiement->qr_code)
                    <a href="{{ route('paiements.genererQrCode', $paiement->id) }}" class="btn btn-info">
                        <i class="fas fa-qrcode me-1"></i>Générer QR Code
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection