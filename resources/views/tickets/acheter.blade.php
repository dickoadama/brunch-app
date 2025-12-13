@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-shopping-cart me-2"></i>Achat de ticket</h4>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour aux tickets
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
                    
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5><i class="fas fa-credit-card me-2"></i>Options de paiement</h5>
                            <p class="text-muted">Sélectionnez votre méthode de paiement préférée :</p>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 feature-card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-mobile-alt fa-2x text-primary mb-2"></i>
                                            <h6>Mobile Money</h6>
                                            <p class="small text-muted">MTN, Orange Money</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 feature-card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-university fa-2x text-primary mb-2"></i>
                                            <h6>Virement bancaire</h6>
                                            <p class="small text-muted">Transfert bancaire</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 feature-card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-wallet fa-2x text-primary mb-2"></i>
                                            <h6>Sur place</h6>
                                            <p class="small text-muted">Paiement au comptoir</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Instructions importantes</h5>
                        <ul class="mb-0">
                            <li>Après avoir effectué le paiement, conservez votre reçu</li>
                            <li>Vous recevrez un email de confirmation avec votre ticket</li>
                            <li>Le ticket est valable 1 mois à partir de la date d'achat</li>
                        </ul>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-success btn-lg" onclick="showNotification('Paiement simulé avec succès ! Vous recevrez votre ticket par email.', 'success')">
                            <i class="fas fa-check-circle me-1"></i>Payer maintenant ({{ number_format($ticket->prix, 0, ',', ' ') }} CFA)
                        </button>
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Annuler l'achat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fonction pour afficher les notifications (utilise la fonction déjà définie dans le layout)
function showNotification(message, type) {
    // Si la fonction existe dans le scope global, on l'utilise
    if (typeof window.showNotification === 'function') {
        window.showNotification(message, type);
    } else {
        // Sinon, on affiche une alerte simple
        alert(message);
    }
}
</script>
@endsection