@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-list me-2"></i>Liste des Commandes Prédéfinies</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour au tableau de bord
        </a>
    </div>
    
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>Commandes avec Menus et Tables</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Commande #</th>
                            <th>Client</th>
                            <th>Menu</th>


                            <th>Table</th>
                            <th>Personnes</th>
                            <th>Prix (FCFA)</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CMD-2025-001</td>
                            <td>Jean Martin</td>
                            <td>Brunch Complet</td>


                            <td>T001 (Terrasse)</td>
                            <td>2</td>
                            <td>7 750 FCFA</td>
                            <td><span class="badge bg-success">Confirmée</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#CMD-2025-002</td>
                            <td>Marie Dubois</td>
                            <td>Déjeuner Léger</td>


                            <td>T002 (Intérieur)</td>
                            <td>1</td>
                            <td>6 000 FCFA</td>
                            <td><span class="badge bg-warning">En attente</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#CMD-2025-003</td>
                            <td>Pierre Lambert</td>
                            <td>Brunch Familial</td>


                            <td>T003 (Terrasse)</td>
                            <td>4</td>
                            <td>14 250 FCFA</td>
                            <td><span class="badge bg-success">Confirmée</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#CMD-2025-004</td>
                            <td>Sophie Petit</td>
                            <td>Petit Déjeuner</td>


                            <td>T004 (Intérieur)</td>
                            <td>1</td>
                            <td>4 250 FCFA</td>
                            <td><span class="badge bg-info">Préparation</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#CMD-2025-005</td>
                            <td>Luc Bernard</td>
                            <td>Brunch Végétarien</td>


                            <td>T005 (Terrasse)</td>
                            <td>2</td>
                            <td>7 000 FCFA</td>
                            <td><span class="badge bg-success">Confirmée</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <p class="mb-0"><strong>Total des commandes :</strong> 5</p>
                    <p class="mb-0"><strong>Revenu total :</strong> 39 250 FCFA</p>
                </div>
                <div>
                    <button class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Nouvelle Commande
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Répartition des Menus</h5>
                </div>
                <div class="card-body">
                    <canvas id="menuChart" height="150"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fas fa-euro-sign me-2"></i>Revenus par Menu</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique de répartition des menus
        const menuCtx = document.getElementById('menuChart').getContext('2d');
        const menuChart = new Chart(menuCtx, {
            type: 'doughnut',
            data: {
                labels: ['Brunch Complet', 'Déjeuner Léger', 'Brunch Familial', 'Petit Déjeuner', 'Brunch Végétarien'],
                datasets: [{
                    data: [1, 1, 1, 1, 1],
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
        
        // Graphique des revenus par menu
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Brunch Complet', 'Déjeuner Léger', 'Brunch Familial', 'Petit Déjeuner', 'Brunch Végétarien'],
                datasets: [{
                    label: 'Revenus (CFA)',
                    data: [7750, 6000, 14250, 4250, 7000],
                    backgroundColor: '#28a745'
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
    });
</script>
@endsection