@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-money-bill-wave me-2"></i>Gestion des Paiements</h1>
        <a href="{{ route('paiements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i>Nouveau Paiement
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInRight">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Paiements</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $paiements->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Montant Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($paiements->sum('montant'), 2, ',', ' ') }} FCFA
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Paiements En Attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $paiements->where('statut', 'en_attente')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Paiements</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Actions:</div>
                    <a class="dropdown-item" href="{{ route('paiements.create') }}">Ajouter Paiement</a>
                    <a class="dropdown-item" href="#">Exporter</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Trier par Date</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Référence</th>
                            <th>Montant</th>
                            <th>Méthode</th>
                            <th>Statut</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paiements as $paiement)
                            <tr class="animate__animated animate__fadeInUp">
                                <td>
                                    <i class="fas fa-barcode text-primary me-2"></i>
                                    <strong>{{ $paiement->reference }}</strong>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">{{ number_format($paiement->montant, 2, ',', ' ') }} FCFA</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($paiement->methode) }}</span>
                                </td>
                                <td>
                                    @if($paiement->statut == 'en_attente')
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif($paiement->statut == 'valide')
                                        <span class="badge bg-success">Validé</span>
                                    @elseif($paiement->statut == 'annule')
                                        <span class="badge bg-danger">Annulé</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($paiement->statut) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($paiement->commande_id)
                                        <span class="badge bg-primary">Commande</span>
                                    @elseif($paiement->reservation_id)
                                        <span class="badge bg-info">Réservation</span>
                                    @elseif($paiement->ticket_id)
                                        <span class="badge bg-success">Ticket</span>
                                    @else
                                        <span class="badge bg-secondary">Autre</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('paiements.show', $paiement->id) }}" class="btn btn-info btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement?')" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                    <p class="mb-0">Aucun paiement trouvé.</p>
                                    <a href="{{ route('paiements.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-1"></i>Créer votre premier paiement
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection