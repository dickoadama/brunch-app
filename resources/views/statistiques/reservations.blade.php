@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-calendar-check me-2"></i>Statistiques des Réservations</h1>
        <div>
            <button class="btn btn-outline-primary">
                <i class="fas fa-calendar-plus me-1"></i>Nouvelle réservation
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    
    <!-- Résumé des réservations -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-2x text-primary mb-2"></i>
                    <h5>Total réservations</h5>
                    <p class="display-6">856</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-plus fa-2x text-success mb-2"></i>
                    <h5>Nouvelles ce mois</h5>
                    <p class="display-6 text-success">68</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-day fa-2x text-info mb-2"></i>
                    <h5>Réservations aujourd'hui</h5>
                    <p class="display-6 text-info">24</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-warning mb-2"></i>
                    <h5>Personnes attendues</h5>
                    <p class="display-6 text-warning">156</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Graphiques réservations -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Évolution des réservations</h5>
                </div>
                <div class="card-body">
                    <canvas id="reservationsChart" height="100"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Créneaux populaires</h5>
                </div>
                <div class="card-body">
                    <canvas id="timeSlotsChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Calendrier des réservations -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Calendrier des réservations</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <i class="fas fa-calendar-day me-2"></i>Aujourd'hui
                            <span class="badge bg-light text-dark float-end">24</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-day me-2"></i>Demain
                            <span class="badge bg-light text-dark float-end">18</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-day me-2"></i>12/12/2025
                            <span class="badge bg-light text-dark float-end">22</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-day me-2"></i>13/12/2025
                            <span class="badge bg-light text-dark float-end">15</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-day me-2"></i>14/12/2025
                            <span class="badge bg-light text-dark float-end">19</span>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Heure</th>
                                    <th>Table 1</th>
                                    <th>Table 2</th>
                                    <th>Table 3</th>
                                    <th>Table 4</th>
                                    <th>Table 5</th>
                                    <th>Table 6</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>09:00</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-warning text-dark">Réservée</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                </tr>
                                <tr>
                                    <td>10:00</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-warning text-dark">Réservée</td>
                                    <td class="bg-success text-white">Libre</td>
                                </tr>
                                <tr>
                                    <td>11:00</td>
                                    <td class="bg-warning text-dark">Réservée</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-warning text-dark">Réservée</td>
                                </tr>
                                <tr>
                                    <td>12:00</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-danger text-white">Occupée</td>
                                    <td class="bg-success text-white">Libre</td>
                                </tr>
                                <tr>
                                    <td>13:00</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                    <td class="bg-success text-white">Libre</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Détails des réservations -->
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Liste des réservations</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Rechercher une réservation...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i>Filtrer
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Toutes</a></li>
                                <li><a class="dropdown-item" href="#">Confirmées</a></li>
                                <li><a class="dropdown-item" href="#">En attente</a></li>
                                <li><a class="dropdown-item" href="#">Annulées</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date & Heure</th>
                            <th>Client</th>
                            <th>Personnes</th>
                            <th>Table</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10/12/2025 12:00</td>
                            <td>Jean Martin</td>
                            <td>4</td>
                            <td>Table 3</td>
                            <td><span class="badge bg-success">Confirmée</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>10/12/2025 13:30</td>
                            <td>Marie Dubois</td>
                            <td>2</td>
                            <td>Table 1</td>
                            <td><span class="badge bg-warning">En attente</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>11/12/2025 10:00</td>
                            <td>Pierre Lambert</td>
                            <td>6</td>
                            <td>Table 5</td>
                            <td><span class="badge bg-success">Confirmée</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>11/12/2025 12:30</td>
                            <td>Sophie Petit</td>
                            <td>3</td>
                            <td>Table 2</td>
                            <td><span class="badge bg-danger">Annulée</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>12/12/2025 09:30</td>
                            <td>Luc Bernard</td>
                            <td>2</td>
                            <td>Table 4</td>
                            <td><span class="badge bg-success">Confirmée</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <nav aria-label="Pagination des réservations">
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
        // Graphique des réservations
        const reservationsCtx = document.getElementById('reservationsChart').getContext('2d');
        const reservationsChart = new Chart(reservationsCtx, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Réservations',
                    data: [85, 92, 105, 120, 135, 156, 142],
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
        
        // Graphique des créneaux horaires
        const timeSlotsCtx = document.getElementById('timeSlotsChart').getContext('2d');
        const timeSlotsChart = new Chart(timeSlotsCtx, {
            type: 'pie',
            data: {
                labels: ['09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00', '13:00-14:00'],
                datasets: [{
                    data: [15, 25, 35, 42, 28],
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