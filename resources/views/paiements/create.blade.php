@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-plus-circle me-2"></i>Nouveau Paiement</h1>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Détails du Paiement</h5>
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
                    
                    <form action="{{ route('paiements.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="montant" class="form-label"><i class="fas fa-euro-sign me-1"></i> Montant (FCFA) :</label>
                                    <input type="number" step="0.01" name="montant" id="montant" class="form-control" value="{{ old('montant') }}" required placeholder="Ex: 25.50">
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
                        
                        <div class="form-group mb-3">
                            <label class="form-label"><i class="fas fa-link me-1"></i> Type de Transaction :</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="transaction_type" id="commande" value="commande" checked>
                                <label class="form-check-label" for="commande">
                                    Commande
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="transaction_type" id="reservation" value="reservation">
                                <label class="form-check-label" for="reservation">
                                    Réservation
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="transaction_type" id="ticket" value="ticket">
                                <label class="form-check-label" for="ticket">
                                    Ticket
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3" id="commande_field">
                            <label for="commande_id" class="form-label"><i class="fas fa-shopping-cart me-1"></i> Commande Associée :</label>
                            <select name="commande_id" id="commande_id" class="form-control">
                                <option value="">Sélectionnez une commande</option>
                                @foreach(App\Models\Commande::all() as $commande)
                                    <option value="{{ $commande->id }}" {{ old('commande_id') == $commande->id ? 'selected' : '' }}>
                                        Commande #{{ $commande->id }} - {{ $commande->client->nom ?? 'Client inconnu' }} - {{ number_format($commande->montant_total ?? 0, 2, ',', ' ') }} FCFA
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mb-3 d-none" id="reservation_field">
                            <label for="reservation_id" class="form-label"><i class="fas fa-calendar-check me-1"></i> Réservation Associée :</label>
                            <select name="reservation_id" id="reservation_id" class="form-control">
                                <option value="">Sélectionnez une réservation</option>
                                @foreach(App\Models\Reservation::all() as $reservation)
                                    <option value="{{ $reservation->id }}" {{ old('reservation_id') == $reservation->id ? 'selected' : '' }}>
                                        Réservation #{{ $reservation->id }} - Table {{ $reservation->table->numero_table ?? 'N/A' }} - {{ $reservation->date_reservation->format('d/m/Y H:i') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mb-3 d-none" id="ticket_field">
                            <label for="ticket_id" class="form-label"><i class="fas fa-ticket-alt me-1"></i> Ticket Associé :</label>
                            <select name="ticket_id" id="ticket_id" class="form-control">
                                <option value="">Sélectionnez un ticket</option>
                                @foreach(App\Models\Ticket::all() as $ticket)
                                    <option value="{{ $ticket->id }}" {{ old('ticket_id') == $ticket->id ? 'selected' : '' }}>
                                        Ticket #{{ $ticket->id }} - {{ $ticket->nom }} - {{ number_format($ticket->prix, 2, ',', ' ') }} FCFA
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('paiements.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Créer le Paiement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow sticky-top" style="top: 20px;">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Conseils</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Vérifiez le montant avant de valider</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Sélectionnez la bonne méthode de paiement</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Liez le paiement à la transaction appropriée</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Générez le QR code après validation</li>
                    </ul>
                    <div class="text-center mt-4">
                        <i class="fas fa-qrcode fa-3x text-primary"></i>
                        <p class="mt-2 mb-0">QR Code de Paiement</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const transactionTypeInputs = document.querySelectorAll('input[name="transaction_type"]');
    const commandeField = document.getElementById('commande_field');
    const reservationField = document.getElementById('reservation_field');
    const ticketField = document.getElementById('ticket_field');
    
    transactionTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Masquer tous les champs
            commandeField.classList.add('d-none');
            reservationField.classList.add('d-none');
            ticketField.classList.add('d-none');
            
            // Afficher le champ sélectionné
            if (this.value === 'commande') {
                commandeField.classList.remove('d-none');
            } else if (this.value === 'reservation') {
                reservationField.classList.remove('d-none');
            } else if (this.value === 'ticket') {
                ticketField.classList.remove('d-none');
            }
        });
    });
});
</script>
@endsection