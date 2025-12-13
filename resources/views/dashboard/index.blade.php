@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-chart-line me-2"></i>Tableau de bord</h1>
        <div>
            <button class="btn btn-outline-primary" id="refresh-dashboard">
                <i class="fas fa-sync-alt me-1"></i>Actualiser
            </button>
        </div>
    </div>
    
    <!-- Statistiques principales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow dashboard-card animate__animated animate__fadeInUp">
                <div class="card-body text-center">
                    <i class="fas fa-euro-sign fa-2x text-success mb-2"></i>
                    <h5>Revenus du mois</h5>
                    <p class="display-6 text-success">FCFA12,450</p>
                    <small class="text-muted">+12% par rapport au mois dernier</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow dashboard-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h5>Clients actifs</h5>
                    <p class="display-6 text-primary">142</p>
                    <small class="text-muted">+8% par rapport au mois dernier</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow dashboard-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-2x text-info mb-2"></i>
                    <h5>Réservations</h5>
                    <p class="display-6 text-info">56</p>
                    <small class="text-muted">Ce mois-ci</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow dashboard-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="card-body text-center">
                    <i class="fas fa-utensils fa-2x text-warning mb-2"></i>
                    <h5>Menus vendus</h5>
                    <p class="display-6 text-warning">234</p>
                    <small class="text-muted">Cette semaine</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Graphiques -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Performance des ventes (30 derniers jours)</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="100"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Répartition des ventes</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesDistributionChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Activités récentes -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Activités récentes</h5>
                </div>
                <div class="card-body">
                    <div class="activity-feed">
                        <div class="feed-item">
                            <div class="feed-date">Il y a 10 min</div>
                            <div class="feed-text">
                                <i class="fas fa-shopping-cart text-success me-2"></i>
                                <strong>Nouvelle commande</strong> #CMD-2025-001 passée par Jean Dupont
                            </div>
                        </div>
                        
                        <div class="feed-item">
                            <div class="feed-date">Il y a 25 min</div>
                            <div class="feed-text">
                                <i class="fas fa-calendar-check text-info me-2"></i>
                                <strong>Nouvelle réservation</strong> #RES-2025-045 confirmée pour Marie Martin
                            </div>
                        </div>
                        
                        <div class="feed-item">
                            <div class="feed-date">Il y a 1 heure</div>
                            <div class="feed-text">
                                <i class="fas fa-user-plus text-primary me-2"></i>
                                <strong>Nouveau client</strong> Pierre Lambert enregistré
                            </div>
                        </div>
                        
                        <div class="feed-item">
                            <div class="feed-date">Il y a 2 heures</div>
                            <div class="feed-text">
                                <i class="fas fa-euro-sign text-warning me-2"></i>
                                <strong>Paiement reçu</strong> pour la commande #CMD-2025-001
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Alertes importantes</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Stock bas :</strong> Le stock d'ingrédients "Tomates" est presque épuisé.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Rappel :</strong> 3 réservations arrivent aujourd'hui.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Urgent :</strong> 2 commandes en retard à expédier.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mt-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Événements à venir</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-birthday-cake text-info me-2"></i>
                                Anniversaire de Marie Dubois
                            </div>
                            <span class="badge bg-info rounded-pill">15 déc</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-gift text-success me-2"></i>
                                Promotion spéciale week-end
                            </div>
                            <span class="badge bg-success rounded-pill">17-18 déc</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-tools text-warning me-2"></i>
                                Maintenance équipements
                            </div>
                            <span class="badge bg-warning rounded-pill">20 déc</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique des ventes
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['1 déc', '5 déc', '10 déc', '15 déc', '20 déc', '25 déc', '30 déc'],
                datasets: [{
                    label: 'Ventes (FCFA)',
                    data: [1200, 1900, 1500, 2500, 2200, 3000, 2800],
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Graphique de répartition
        const distributionCtx = document.getElementById('salesDistributionChart').getContext('2d');
        const distributionChart = new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Menus', 'Boissons', 'Desserts', 'Autres'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#ffc107',
                        '#6c757d'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        // Bouton d'actualisation
        document.getElementById('refresh-dashboard').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Actualisation...';
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-sync-alt me-1"></i>Actualiser';
                // Animation de notification
                showNotification('Tableau de bord actualisé avec succès!', 'success');
            }, 1500);
        });
    });
</script>
@endsection