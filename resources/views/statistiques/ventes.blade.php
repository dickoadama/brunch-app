@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-euro-sign me-2"></i>Statistiques des Ventes</h1>
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i>Filtrer
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                    <li><a class="dropdown-item" href="#">Cette semaine</a></li>
                    <li><a class="dropdown-item" href="#">Ce mois</a></li>
                    <li><a class="dropdown-item" href="#">Cette année</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Personnalisé</a></li>
                </ul>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <!-- Résumé des ventes -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-2x text-primary mb-2"></i>
                    <h5>Total des commandes</h5>
                    <p class="display-6">142</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-euro-sign fa-2x text-success mb-2"></i>
                    <h5>Revenus totaux</h5>
                    <p class="display-6 text-success">FCFA28,450</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-utensils fa-2x text-warning mb-2"></i>
                    <h5>Menus vendus</h5>
                    <p class="display-6 text-warning">356</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-percentage fa-2x text-info mb-2"></i>
                    <h5>Taux de conversion</h5>
                    <p class="display-6 text-info">68%</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Graphiques détaillés -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Évolution des ventes</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesEvolutionChart" height="100"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-star me-2"></i>Menus populaires</h5>
                </div>
                <div class="card-body">
                    <canvas id="popularMenusChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Détails des ventes -->
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Détails des ventes</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Commande #</th>
                            <th>Client</th>
                            <th>Menu</th>
                            <th>Quantité</th>
                            <th>Montant (FCFA)</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10/12/2025</td>
                            <td>#CMD-2025-042</td>
                            <td>Jean Martin</td>
                            <td>Brunch Complet</td>
                            <td>2</td>
                            <td>FCFA24.00</td>
                            <td><span class="badge bg-success">Payé</span></td>
                        </tr>
                        <tr>
                            <td>10/12/2025</td>
                            <td>#CMD-2025-041</td>
                            <td>Marie Dubois</td>
                            <td>Pancakes Maison</td>
                            <td>1</td>
                            <td>FCFA12.50</td>
                            <td><span class="badge bg-success">Payé</span></td>
                        </tr>
                        <tr>
                            <td>09/12/2025</td>
                            <td>#CMD-2025-040</td>
                            <td>Pierre Lambert</td>
                            <td>Omelette du Chef</td>
                            <td>3</td>
                            <td>FCFA27.00</td>
                            <td><span class="badge bg-success">Payé</span></td>
                        </tr>
                        <tr>
                            <td>09/12/2025</td>
                            <td>#CMD-2025-039</td>
                            <td>Sophie Petit</td>
                            <td>Salade Brunch</td>
                            <td>2</td>
                            <td>FCFA18.00</td>
                            <td><span class="badge bg-warning">En attente</span></td>
                        </tr>
                        <tr>
                            <td>08/12/2025</td>
                            <td>#CMD-2025-038</td>
                            <td>Luc Bernard</td>
                            <td>Avocado Toast</td>
                            <td>1</td>
                            <td>FCFA9.50</td>
                            <td><span class="badge bg-success">Payé</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <nav aria-label="Pagination des ventes">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Précédent</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Suivant</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique d'évolution des ventes
        const evolutionCtx = document.getElementById('salesEvolutionChart').getContext('2d');
        const evolutionChart = new Chart(evolutionCtx, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Ventes (FCFA)',
                    data: [1200, 1900, 1500, 2500, 2200, 3000, 2800],
                    backgroundColor: '#0d6efd',
                    borderColor: '#0b5ed7',
                    borderWidth: 1
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
        
        // Graphique des menus populaires
        const popularCtx = document.getElementById('popularMenusChart').getContext('2d');
        const popularChart = new Chart(popularCtx, {
            type: 'pie',
            data: {
                labels: ['Brunch Complet', 'Pancakes Maison', 'Omelette du Chef', 'Salade Brunch', 'Avocado Toast'],
                datasets: [{
                    data: [35, 25, 20, 12, 8],
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#ffc107',
                        '#dc3545',
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
    });
</script>
@endsection