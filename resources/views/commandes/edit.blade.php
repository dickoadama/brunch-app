@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-cart-arrow-down me-2"></i>Modifier la commande</h4>
                    <a href="{{ route('commandes.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger animate__animated animate__shakeX">
                            <i class="fas fa-exclamation-triangle me-2"></i>Veuillez corriger les erreurs ci-dessous :
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_id" class="form-label">
                                        <i class="fas fa-user me-1"></i>Client
                                    </label>
                                    <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                                        <option value="">Sélectionnez un client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ (old('client_id', $commande->client_id) == $client->id) ? 'selected' : '' }}>
                                                {{ $client->nom }} {{ $client->prenom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu_id" class="form-label">
                                        <i class="fas fa-clipboard-list me-1"></i>Menu
                                    </label>
                                    <select name="menu_id" id="menu_id" class="form-control @error('menu_id') is-invalid @enderror" required>
                                        <option value="">Sélectionnez un menu</option>
                                        @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}" {{ (old('menu_id', $commande->menu_id) == $menu->id) ? 'selected' : '' }}>
                                                {{ $menu->nom }} ({{ number_format($menu->prix, 2, ',', ' ') }} FCFA)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('menu_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_commande" class="form-label">
                                        <i class="fas fa-calendar-day me-1"></i>Date de commande
                                    </label>
                                    <input type="datetime-local" name="date_commande" id="date_commande" 
                                           class="form-control @error('date_commande') is-invalid @enderror" 
                                           value="{{ old('date_commande', $commande->date_commande->format('Y-m-d\TH:i')) }}" required>
                                    @error('date_commande')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantite" class="form-label">
                                        <i class="fas fa-sort-numeric-up me-1"></i>Quantité
                                    </label>
                                    <input type="number" name="quantite" id="quantite" 
                                           class="form-control @error('quantite') is-invalid @enderror" 
                                           value="{{ old('quantite', $commande->quantite) }}" min="1" required>
                                    @error('quantite')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="montant_total" class="form-label">
                                        <i class="fas fa-euro-sign me-1"></i>Montant Total (FCFA)
                                    </label>
                                    <input type="number" step="0.01" name="montant_total" id="montant_total" 
                                           class="form-control @error('montant_total') is-invalid @enderror" 
                                           value="{{ old('montant_total', $commande->montant_total) }}" required>
                                    @error('montant_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="statut" class="form-label">
                                        <i class="fas fa-info-circle me-1"></i>Statut
                                    </label>
                                    <select name="statut" id="statut" class="form-control @error('statut') is-invalid @enderror" required>
                                        <option value="en attente" {{ (old('statut', $commande->statut) == 'en attente') ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmée" {{ (old('statut', $commande->statut) == 'confirmée') ? 'selected' : '' }}>Confirmée</option>
                                        <option value="annulée" {{ (old('statut', $commande->statut) == 'annulée') ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                    @error('statut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="notes" class="form-label">
                                <i class="fas fa-sticky-note me-1"></i>Notes (optionnel)
                            </label>
                            <textarea name="notes" id="notes" rows="3" 
                                      class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $commande->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-sync-alt me-1"></i>Mettre à jour la commande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4 border-left-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">
                        <i class="fas fa-lightbulb me-2"></i>Conseils pour les commandes
                    </h5>
                    <ul class="mb-0">
                        <li>Informez le client de tout changement de commande</li>
                        <li>Vérifiez la disponibilité des menus avant de modifier</li>
                        <li>Documentez les raisons des modifications dans les notes</li>
                        <li>Assurez-vous que tous les détails sont corrects avant de sauvegarder</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuSelect = document.getElementById('menu_id');
    const quantityInput = document.getElementById('quantite');
    const amountInput = document.getElementById('montant_total');
    
    function calculateAmount() {
        const selectedOption = menuSelect.options[menuSelect.selectedIndex];
        if (selectedOption && selectedOption.text) {
            const priceMatch = selectedOption.text.match(/([\d,]+(\.\d{2})?)\s*FCFA/);
            if (priceMatch) {
                const price = parseFloat(priceMatch[1].replace(',', '.'));
                const quantity = parseInt(quantityInput.value) || 1;
                const total = price * quantity;
                amountInput.value = total.toFixed(2).replace('.', ',');
            }
        }
    }
    
    menuSelect.addEventListener('change', calculateAmount);
    quantityInput.addEventListener('input', calculateAmount);
    
    // Initial calculation
    calculateAmount();
});
</script>
@endsection