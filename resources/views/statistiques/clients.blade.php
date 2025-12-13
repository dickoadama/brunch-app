@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-users me-2"></i>Statistiques des Clients</h1>
        <div>
            <button class="btn btn-outline-primary">
                <i class="fas fa-download me-1"></i>Exporter
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <!-- Résumé des clients -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h5>Total clients</h5>
                    <p class="display-6">1,242</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-user-plus fa-2x text-success mb-2"></i>
                    <h5>Nouveaux ce mois</h5>
                    <p class="display-6 text-success">42</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-user-check fa-2x text-info mb-2"></i>
                    <h5>Clients actifs</h5>
                    <p class="display-6 text-info">856</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-user-clock fa-2x text-warning mb-2"></i>
                    <h5>Clients inactifs</h5>
                    <p class="display-6 text-warning">386</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Graphiques clients -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Inscriptions mensuelles</h5>
                </div>
                <div class="card-body">
                    <canvas id="registrationsChart" height="100"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Répartition géographique</h5>
                </div>
                <div class="card-body">
                    <canvas id="geographicChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Détails des clients -->
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Liste des clients</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Rechercher un client...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i>Filtrer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Tous</a></li>
                                <li><a class="dropdown-item" href="#">Actifs</a></li>
                                <li><a class="dropdown-item" href="#">Inactifs</a></li>
                                <li><a class="dropdown-item" href="#">VIP</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Inscrit le</th>
                            <th>Commandes</th>
                            <th>Total dépensé (FCFA)</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jean Martin</td>
                            <td>jean.martin@email.com</td>
                            <td>07 12 34 56 78</td>
                            <td>15/03/2025</td>
                            <td>12</td>
                            <td>FCFA245.50</td>
                            <td><span class="badge bg-success">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Marie Dubois</td>
                            <td>marie.dubois@email.com</td>
                            <td>06 98 76 54 32</td>
                            <td>22/05/2025</td>
                            <td>8</td>
                            <td>FCFA189.20</td>
                            <td><span class="badge bg-success">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Pierre Lambert</td>
                            <td>pierre.lambert@email.com</td>
                            <td>07 55 44 33 22</td>
                            <td>10/07/2025</td>
                            <td>5</td>
                            <td>FCFA98.75</td>
                            <td><span class="badge bg-warning">Inactif</span></td>
                        </tr>
                        <tr>
                            <td>Sophie Petit</td>
                            <td>sophie.petit@email.com</td>
                            <td>06 11 22 33 44</td>
                            <td>05/09/2025</td>
                            <td>15</td>
                            <td>FCFA356.80</td>
                            <td><span class="badge bg-success">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Luc Bernard</td>
                            <td>luc.bernard@email.com</td>
                            <td>07 88 99 00 11</td>
                            <td>18/10/2025</td>
                            <td>3</td>
                            <td>FCFA67.30</td>
                            <td><span class="badge bg-warning">Inactif</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <nav aria-label="Pagination des clients">
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
        // Graphique des inscriptions
        const registrationsCtx = document.getElementById('registrationsChart').getContext('2d');
        const registrationsChart = new Chart(registrationsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Nouveaux clients',
                    data: [42, 38, 56, 45, 62, 58, 71, 65, 78, 82, 95, 88],
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
        
        // Graphique géographique
        const geographicCtx = document.getElementById('geographicChart').getContext('2d');
        const geographicChart = new Chart(geographicCtx, {
            type: 'doughnut',
            data: {
                labels: ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Lille', 'Autres'],
                datasets: [{
                    data: [35, 20, 15, 12, 8, 10],
                    backgroundColor: [
                        '#0d6efd',
                        '#198754',
                        '#ffc107',
                        '#dc3545',
                        '#6c757d',
                        '#6f42c1'
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