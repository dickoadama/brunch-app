@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-shopping-cart me-2"></i>Panier d'achats</h1>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour aux tickets
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(empty($panier))
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            Votre panier est vide. <a href="{{ route('tickets.index') }}">Achetez des tickets</a> pour commencer.
        </div>
    @else
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Récapitulatif de votre panier</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($panier as $item)
                            <tr>
                                <td>{{ $item['nom'] }}</td>
                                <td>{{ number_format($item['prix'], 0, ',', ' ') }} CFA</td>
                                <td>
                                    <form action="{{ route('panier.mettreAJour', $item['id']) }}" method="POST" class="d-flex">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1" class="form-control form-control-sm me-2" style="width: 80px;">
                                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Mettre à jour">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ number_format($item['prix'] * $item['quantite'], 0, ',', ' ') }} CFA</td>
                                <td>
                                    <form action="{{ route('panier.supprimer', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket du panier?')" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total à payer :</th>
                                <th>{{ number_format($total, 0, ',', ' ') }} CFA</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <form action="{{ route('panier.vider') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir vider votre panier?')" title="Vider le panier">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    
                    <div>
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary me-2" title="Ajouter d'autres tickets">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                        <button type="button" class="btn btn-success" onclick="showNotification('Fonctionnalité de paiement à implémenter', 'info')" title="Procéder au paiement">
                            <i class="fas fa-credit-card"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations importantes</h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Les tickets achetés sont valables 1 mois à partir de la date d'achat</li>
                    <li>Vous recevrez un email de confirmation avec vos tickets après paiement</li>
                    <li>Les tickets peuvent être utilisés pour des commandes ou réservations</li>
                    <li>Les tickets ne sont ni remboursables ni échangeables</li>
                </ul>
            </div>
        </div>
    @endif
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