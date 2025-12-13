@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-address-book me-2"></i>Contacts
                    </h4>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 feature-card">
                                <div class="card-body text-center">
                                    <div class="feature-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <h5>Adresse</h5>
                                    <p class="text-muted">Abidjan, Cocody<br>Riviera Palmeraie</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 feature-card">
                                <div class="card-body text-center">
                                    <div class="feature-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h5>Téléphone</h5>
                                    <p class="text-muted">
                                        <a href="tel:+2250767294255">+225 07 672 942 55</a><br>
                                        <a href="tel:+2250555786430">+225 05 557 864 30</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 feature-card">
                                <div class="card-body text-center">
                                    <div class="feature-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h5>Email</h5>
                                    <p class="text-muted">
                                        <a href="mailto:asaelaser@gmail.com">asaelaser@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 feature-card">
                                <div class="card-body text-center">
                                    <div class="feature-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h5>Horaires</h5>
                                    <p class="text-muted">
                                        Lun-Ven: 8h00 - 20h00<br>
                                        Sam-Dim: 9h00 - 18h00
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5><i class="fas fa-comment-dots me-2"></i>Nous contacter</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nom" class="form-label">Nom complet</label>
                                        <input type="text" class="form-control" id="nom" placeholder="Votre nom complet">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Votre email">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="sujet" class="form-label">Sujet</label>
                                    <input type="text" class="form-control" id="sujet" placeholder="Sujet de votre message">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Votre message"></textarea>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-1"></i>Envoyer le message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection