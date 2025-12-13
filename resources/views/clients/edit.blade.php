@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-user-edit me-2"></i>Modifier le client</h1>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>{{ $client->prenom }} {{ $client->nom }}</h5>
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
                    
                    <form action="{{ route('clients.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nom" class="form-label"><i class="fas fa-user me-1"></i> Nom :</label>
                                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $client->nom) }}" required placeholder="Ex: Dupont">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="prenom" class="form-label"><i class="fas fa-user me-1"></i> Prénom :</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $client->prenom) }}" required placeholder="Ex: Jean">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i> Email :</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $client->email) }}" required placeholder="Ex: jean.dupont@email.com">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="telephone" class="form-label"><i class="fas fa-phone me-1"></i> Téléphone :</label>
                                    <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $client->telephone) }}" placeholder="Ex: 01 23 45 67 89">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date_naissance" class="form-label"><i class="fas fa-birthday-cake me-1"></i> Date de naissance :</label>
                                    <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{ old('date_naissance', $client->date_naissance) }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="adresse" class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Adresse :</label>
                            <textarea name="adresse" id="adresse" class="form-control" rows="3" placeholder="Ex: 123 Rue de la Paix, 75000 Paris">{{ old('adresse', $client->adresse) }}</textarea>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('clients.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Mettre à jour le client
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
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Vérifiez l'exactitude de l'email</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Respectez le format du téléphone</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Indiquez une date de naissance valide</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Complétez l'adresse complète</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Les champs marqués * sont obligatoires</li>
                    </ul>
                    <div class="text-center mt-4">
                        <i class="fas fa-users fa-3x text-primary"></i>
                        <p class="mt-2 mb-0">Gestion client optimale</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection