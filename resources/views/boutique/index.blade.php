@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-store me-2"></i>Boutique en ligne</h1>
        <div class="btn-group" role="group">
            <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                <i class="fas fa-ticket-alt me-1"></i>Ticket
            </a>
            <a href="{{ route('menus.create') }}" class="btn btn-success">
                <i class="fas fa-clipboard-list me-1"></i>Menu
            </a>
            <a href="{{ route('tables.create') }}" class="btn btn-info">
                <i class="fas fa-chair me-1"></i>Table
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInRight">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Section des Tickets -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Tickets disponibles</h5>
            <a href="{{ route('tickets.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-eye me-1"></i>Voir tout
            </a>
        </div>
        <div class="card-body">
            @if($tickets->count() > 0)
                <div class="row">
                    @foreach($tickets as $ticket)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $ticket->nom }}</h5>
                                    <p class="card-text">{{ $ticket->description ?? 'Aucune description' }}</p>
                                    <h4 class="text-primary">{{ number_format($ticket->prix, 0, ',', ' ') }} FCFA</h4>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('tickets.acheter', $ticket) }}" class="btn btn-primary">
                                            <i class="fas fa-shopping-cart me-1"></i>Acheter
                                        </a>
                                        @if($ticket->id)
                                        <form action="{{ route('panier.ajouter', ['type' => 'ticket', 'id' => $ticket->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">
                                                <i class="fas fa-cart-plus me-1"></i>Ajouter au panier
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                    <p class="mb-0">Aucun ticket disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Section des Menus -->
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Menus disponibles</h5>
            <a href="{{ route('menus.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-eye me-1"></i>Voir tout
            </a>
        </div>
        <div class="card-body">
            @if($menus->count() > 0)
                <div class="row">
                    @foreach($menus as $menu)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100">
                                @if($menu->image_path)
                                    <img src="{{ asset('storage/' . $menu->image_path) }}" class="card-img-top" alt="Image du menu" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-utensils fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $menu->nom }}</h5>
                                    <p class="card-text">{{ $menu->description ?? 'Aucune description' }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">{{ ucfirst($menu->type) }}</span>
                                        <h4 class="text-success mb-0">{{ number_format($menu->prix, 0, ',', ' ') }} FCFA</h4>
                                    </div>
                                    <div class="mt-3 d-grid gap-2">
                                        <a href="{{ route('commandes.create') }}?menu={{ $menu->id }}" class="btn btn-success">
                                            <i class="fas fa-utensils me-1"></i>Commander
                                        </a>
                                        @if($menu->id)
                                        <form action="{{ route('panier.ajouter', ['type' => 'menu', 'id' => $menu->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">
                                                <i class="fas fa-cart-plus me-1"></i>Ajouter au panier
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <p class="mb-0">Aucun menu disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Section des Tables -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-chair me-2"></i>Tables disponibles</h5>
            <a href="{{ route('tables.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-eye me-1"></i>Voir tout
            </a>
        </div>
        <div class="card-body">
            @if($tables->where('disponible', true)->count() > 0)
                <div class="row">
                    @foreach($tables->where('disponible', true) as $table)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100">
                                @if($table->image_path)
                                    <img src="{{ asset('storage/' . $table->image_path) }}" class="card-img-top" alt="Image de la table" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-chair fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">Table #{{ $table->numero }}</h5>
                                    <p class="card-text">{{ $table->description ?? 'Aucune description' }}</p>
                                    <!-- Extraction du prix à partir de la description -->
                                    @php
                                        $prix = 0;
                                        if(preg_match('/(\d+)/', $table->description, $matches)) {
                                            $prix = $matches[0];
                                        }
                                    @endphp
                                    <h4 class="text-info">{{ number_format($prix, 0, ',', ' ') }} FCFA</h4>
                                    <div class="d-flex justify-content-between">
                                        <span><i class="fas fa-users me-1"></i>{{ $table->capacite }} personnes</span>
                                        <span class="badge bg-success">Disponible</span>
                                    </div>
                                    <div class="mt-3 d-grid gap-2">
                                        <a href="{{ route('reservations.create') }}?table={{ $table->id }}" class="btn btn-info">
                                            <i class="fas fa-calendar-plus me-1"></i>Réserver
                                        </a>
                                        @if($table->id)
                                        <!-- Formulaire pour ajouter la table au panier -->
                                        <form action="{{ route('panier.ajouter', ['type' => 'table', 'id' => $table->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-info">
                                                <i class="fas fa-cart-plus me-1"></i>Ajouter au panier
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-chair fa-3x text-muted mb-3"></i>
                    <p class="mb-0">Aucune table disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection