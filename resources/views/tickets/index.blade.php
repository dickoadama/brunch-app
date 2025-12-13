@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="fas fa-ticket-alt me-2"></i>Tickets Disponibles</h1>
                @can('create', App\Models\Ticket::class)
                <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i>Nouveau Ticket
                </a>
                @endcan
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                @forelse($tickets as $ticket)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 feature-card">
                            <div class="card-body d-flex flex-column">
                                <div class="text-center mb-3">
                                    <div class="feature-icon">
                                        <i class="fas fa-ticket-alt text-primary"></i>
                                    </div>
                                    <h3 class="card-title">{{ $ticket->nom }}</h3>
                                </div>
                                
                                <div class="mt-auto">
                                    <div class="text-center">
                                        <h2 class="text-primary fw-bold">{{ number_format($ticket->prix, 0, ',', ' ') }} CFA</h2>
                                        @if($ticket->description)
                                            <p class="text-muted">{{ $ticket->description }}</p>
                                        @endif
                                    </div>
                                    
                                    <div class="d-grid gap-2 mt-3">
                                        <a href="{{ route('tickets.acheter', $ticket) }}" class="btn btn-primary btn-lg" title="Acheter">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                        <form action="{{ route('panier.ajouter', ['type' => 'ticket', 'id' => $ticket->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">
                                                <i class="fas fa-cart-plus me-1"></i>Ajouter au panier
                                            </button>
                                        </form>
                                        @can('update', $ticket)
                                        <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-edit me-1"></i>Modifier
                                        </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucun ticket disponible pour le moment.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection