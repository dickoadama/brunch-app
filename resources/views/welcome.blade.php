@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-4 mb-4 animate__animated animate__fadeInDown animate__delay-0.5s">
                <div class="brunch-title">
                    <i class="fas fa-utensils me-3 animate__animated animate__swing animate__delay-1s"></i>
                    <span class="animate__animated animate__fadeIn animate__delay-0.5s">BRUNCH</span>
                    <span class="animate__animated animate__fadeIn animate__delay-1s">Manager</span>
                </div>
            </h1>
            <p class="lead mb-5 brunch-subtitle animate__animated animate__fadeInUp animate__delay-1.5s">
                Gérez facilement vos recettes, menus, clients et réservations pour votre service de brunch.
            </p>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card feature-card h-100">
                <div class="card-img-top" style="height: 150px; overflow: hidden; border-radius: 15px 15px 0 0;">
                    <img src="{{ asset('images/theme/menu-hero.jpg') }}" alt="Menus" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <div class="feature-icon animate__animated animate__pulse animate__delay-3s">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h5 class="card-title">Menus</h5>
                    <p class="card-text">Créez et organisez vos menus de brunch pour différentes occasions.</p>
                    <a href="{{ route('menus.index') }}" class="btn btn-primary mt-auto">Voir les menus</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card feature-card h-100">
                <div class="card-img-top" style="height: 150px; overflow: hidden; border-radius: 15px 15px 0 0;">
                    <img src="{{ asset('images/theme/reservations-hero.jpg') }}" alt="Réservations" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <div class="feature-icon animate__animated animate__pulse animate__delay-4s">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h5 class="card-title">Réservations</h5>
                    <p class="card-text">Gérez les réservations de vos clients pour les services de brunch.</p>
                    <a href="{{ route('reservations.index') }}" class="btn btn-primary mt-auto">Voir les réservations</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card feature-card h-100">
                <div class="card-img-top" style="height: 150px; overflow: hidden; border-radius: 15px 15px 0 0;">
                    <img src="{{ asset('images/theme/clients-hero.jpg') }}" alt="Clients" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <div class="feature-icon animate__animated animate__pulse animate__delay-5s">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="card-title">Clients</h5>
                    <p class="card-text">Gérez la base de données de vos clients et leurs préférences.</p>
                    <a href="{{ route('clients.index') }}" class="btn btn-primary mt-auto">Voir les clients</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card feature-card h-100">
                <div class="card-img-top" style="height: 150px; overflow: hidden; border-radius: 15px 15px 0 0;">
                    <img src="{{ asset('images/theme/commandes-hero.jpg') }}" alt="Commandes" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <div class="feature-icon animate__animated animate__pulse animate__delay-7s">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h5 class="card-title">Commandes</h5>
                    <p class="card-text">Traitez les commandes de vos clients pour les services de brunch.</p>
                    <a href="{{ route('commandes.index') }}" class="btn btn-primary mt-auto">Voir les commandes</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card border-0 bg-transparent">
                <div class="card-body text-center">
                    <h3 class="mb-4">
                        <i class="fas fa-star text-warning me-2"></i>
                        Pourquoi choisir BRUNCH Manager ?
                        <i class="fas fa-star text-warning ms-2"></i>
                    </h3>
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <i class="fas fa-bolt fa-2x text-primary mb-2"></i>
                                <h5>Rapide & Efficace</h5>
                                <p class="small mb-0">Gestion simplifiée de votre brunch</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <i class="fas fa-sync-alt fa-2x text-success mb-2"></i>
                                <h5>Mise à Jour en Temps Réel</h5>
                                <p class="small mb-0">Informations toujours actuelles</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <i class="fas fa-chart-line fa-2x text-info mb-2"></i>
                                <h5>Analyses Détaillées</h5>
                                <p class="small mb-0">Suivi de vos performances</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <i class="fas fa-shield-alt fa-2x text-warning mb-2"></i>
                                <h5>Sécurisé</h5>
                                <p class="small mb-0">Protection de vos données</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajout de Animate.css pour les animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation personnalisée pour le titre
    const titleElement = document.querySelector('.brunch-title');
    
    // Ajout d'une animation de pulse au chargement
    setTimeout(() => {
        titleElement.classList.add('animate__animated', 'animate__pulse');
    }, 2000);
    
    // Retrait de l'animation après son exécution
    titleElement.addEventListener('animationend', function() {
        titleElement.classList.remove('animate__animated', 'animate__pulse');
    });
});
</script>
@endsection