@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-edit me-2"></i>Modifier le Paiement</h1>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>{{ $paiement->reference }}</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Erreurs de validation :</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('paiements.update', $paiement->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="reference" class="form-label"><i class="fas fa-barcode me-1"></i> Référence :</label>
                                    <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference', $paiement->reference) }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="montant" class="form-label"><i class="fas fa-euro-sign me-1"></i> Montant (FCFA) :</label>
                                    <input type="number" step="0.01" name="montant" id="montant" class="form-control" value="{{ old('montant', $paiement->montant) }}" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="methode" class="form-label"><i class="fas fa-credit-card me-1"></i> Méthode de Paiement :</label>
                                    <input type="text" class="form-control" value="{{ ucfirst(str_replace('_', ' ', $paiement->methode)) }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="statut" class="form-label"><i class="fas fa-sync me-1"></i> Statut :</label>
                                    <select name="statut" id="statut" class="form-control" required>
                                        <option value="en_attente" {{ old('statut', $paiement->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="valide" {{ old('statut', $paiement->statut) == 'valide' ? 'selected' : '' }}>Validé</option>
                                        <option value="annule" {{ old('statut', $paiement->statut) == 'annule' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label"><i class="fas fa-link me-1"></i> Type de Transaction :</label>
                            <div>
                                @if($paiement->commande_id)
                                    <span class="badge bg-primary">Commande #{{ $paiement->commande_id }}</span>
                                @elseif($paiement->reservation_id)
                                    <span class="badge bg-info">Réservation #{{ $paiement->reservation_id }}</span>
                                @elseif($paiement->ticket_id)
                                    <span class="badge bg-success">Ticket #{{ $paiement->ticket_id }}</span>
                                @else
                                    <span class="badge bg-secondary">Aucune transaction associée</span>
                                @endif
                            </div>
                        </div>
                        
                        @if($paiement->qr_code)
                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fas fa-qrcode me-1"></i> QR Code :</label>
                            <div class="text-center">
                                <div class="border p-3 d-inline-block">
                                    <div class="bg-light p-3">
                                        <p class="mb-0">{{ $paiement->qr_code }}</p>
                                    </div>
                                    <p class="mt-2 mb-0"><small>Code de paiement simulé</small></p>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('paiements.genererQrCode', $paiement->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-redo me-1"></i>Regénérer QR Code
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fas fa-qrcode me-1"></i> QR Code :</label>
                            <div class="text-center">
                                <p class="text-muted">Aucun QR code généré pour ce paiement.</p>
                                <a href="{{ route('paiements.genererQrCode', $paiement->id) }}" class="btn btn-primary">
                                    <i class="fas fa-qrcode me-1"></i>Générer QR Code
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('paiements.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Mettre à jour le Paiement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow sticky-top" style="top: 20px;">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <p class="mb-1"><i class="fas fa-calendar-alt text-info"></i> Création</p>
                                <h4 class="mb-0">{{ $paiement->created_at->format('d/m/Y') }}</h4>
                                <small class="text-muted">{{ $paiement->created_at->format('H:i') }}</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <p class="mb-1"><i class="fas fa-history text-warning"></i> Mise à jour</p>
                                <h4 class="mb-0">{{ $paiement->updated_at->format('d/m/Y') }}</h4>
                                <small class="text-muted">{{ $paiement->updated_at->format('H:i') }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <h5><i class="fas fa-receipt me-2"></i>Détails de la Transaction</h5>
                        @if($paiement->commande)
                            <p class="mb-1"><strong>Commande :</strong> #{{ $paiement->commande->id }}</p>
                            <p class="mb-1"><strong>Client :</strong> {{ $paiement->commande->client->nom ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>Total :</strong> {{ number_format($paiement->commande->montant_total ?? 0, 2, ',', ' ') }} FCFA</p>
                        @elseif($paiement->reservation)
                            <p class="mb-1"><strong>Réservation :</strong> #{{ $paiement->reservation->id }}</p>
                            <p class="mb-1"><strong>Table :</strong> {{ $paiement->reservation->table->numero_table ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>Date :</strong> {{ $paiement->reservation->date_reservation->format('d/m/Y H:i') }}</p>
                        @elseif($paiement->ticket)
                            <p class="mb-1"><strong>Ticket :</strong> #{{ $paiement->ticket->id }}</p>
                            <p class="mb-1"><strong>Nom :</strong> {{ $paiement->ticket->nom }}</p>
                            <p class="mb-0"><strong>Prix :</strong> {{ number_format($paiement->ticket->prix, 2, ',', ' ') }} FCFA</p>
                        @else
                            <p class="mb-0 text-muted">Aucune transaction associée</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection