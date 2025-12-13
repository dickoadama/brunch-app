@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Ajouter une nouvelle réservation</h4>
                    <a href="{{ route('reservations.index') }}" class="btn btn-light btn-sm">
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
                    
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_id" class="form-label">
                                        <i class="fas fa-user me-1"></i>Client
                                    </label>
                                    <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                                        <option value="">Sélectionnez un client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
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
                                    <label for="date_reservation" class="form-label">
                                        <i class="fas fa-calendar-day me-1"></i>Date et Heure
                                    </label>
                                    <input type="datetime-local" name="date_reservation" id="date_reservation" 
                                           class="form-control @error('date_reservation') is-invalid @enderror" 
                                           value="{{ old('date_reservation') }}" required>
                                    @error('date_reservation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_personnes" class="form-label">
                                        <i class="fas fa-users me-1"></i>Nombre de personnes
                                    </label>
                                    <input type="number" name="nombre_personnes" id="nombre_personnes" 
                                           class="form-control @error('nombre_personnes') is-invalid @enderror" 
                                           value="{{ old('nombre_personnes') }}" min="1" max="50" required>
                                    @error('nombre_personnes')
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
                                        <option value="en attente" {{ old('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmée" {{ old('statut') == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="annulée" {{ old('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
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
                                      class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Enregistrer la réservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4 border-left-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">
                        <i class="fas fa-lightbulb me-2"></i>Conseils pour les réservations
                    </h5>
                    <ul class="mb-0">
                        <li>Vérifiez la disponibilité avant de confirmer une réservation</li>
                        <li>Contactez le client pour confirmer les détails importants</li>
                        <li>Notez toute exigence alimentaire spéciale dans les notes</li>
                        <li>Mettez à jour le statut dès que possible</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection