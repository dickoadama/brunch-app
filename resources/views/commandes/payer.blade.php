@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-credit-card me-2"></i>Paiement de la Commande #{{ $commande->id }}</h1>
        <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la commande
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Détails de la commande</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-user me-1"></i> Client :</label>
                                <p class="form-control-plaintext">{{ $commande->client->nom ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-utensils me-1"></i> Menu :</label>
                                <p class="form-control-plaintext">{{ $commande->menu->nom ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-calendar me-1"></i> Date :</label>
                                <p class="form-control-plaintext">{{ $commande->date_commande->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-users me-1"></i> Personnes :</label>
                                <p class="form-control-plaintext">{{ $commande->nombre_personnes }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-euro-sign me-1"></i> Montant total :</label>
                        <p class="form-control-plaintext text-success fw-bold fs-5">{{ number_format($commande->montant_total, 2, ',', ' ') }} FCFA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center mt-4">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Effectuer le paiement</h5>
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
                    
                    <form action="{{ route('commandes.traiterPaiement', $commande->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="montant" class="form-label"><i class="fas fa-euro-sign me-1"></i> Montant à payer (FCFA) :</label>
                                    <input type="number" step="0.01" name="montant" id="montant" class="form-control" value="{{ old('montant', $commande->montant_total) }}" required placeholder="Ex: {{ number_format($commande->montant_total, 2, ',', ' ') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="methode" class="form-label"><i class="fas fa-credit-card me-1"></i> Méthode de Paiement :</label>
                                    <select name="methode" id="methode" class="form-control" required>
                                        <option value="">Sélectionnez une méthode</option>
                                        <option value="carte_bancaire" {{ old('methode') == 'carte_bancaire' ? 'selected' : '' }}>Carte Bancaire</option>
                                        <option value="mobile_money" {{ old('methode') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                                        <option value="virement" {{ old('methode') == 'virement' ? 'selected' : '' }}>Virement Bancaire</option>
                                        <option value="especes" {{ old('methode') == 'especes' ? 'selected' : '' }}>Espèces</option>
                                        <option value="cheque" {{ old('methode') == 'cheque' ? 'selected' : '' }}>Chèque</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fas fa-qrcode me-1"></i> QR Code de Paiement :</label>
                            <div class="text-center">
                                <div class="border p-3 d-inline-block">
                                    <div class="bg-light p-3">
                                        <p class="mb-0">QR_CODE_CMD_{{ strtoupper(substr(md5(time()), 0, 10)) }}</p>
                                    </div>
                                    <p class="mt-2 mb-0"><small>Scannez pour payer</small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-1"></i>Confirmer le Paiement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection