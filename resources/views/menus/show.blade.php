@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $menu->nom }}</h1>
    
    <div class="row">
        <div class="col-md-6">
            <p><strong>Type :</strong> {{ $menu->type }}</p>
            <p><strong>Date :</strong> {{ $menu->date_menu->format('d/m/Y') }}</p>
            <p><strong>Prix :</strong> {{ $menu->prix }} FCFA</p>
        </div>
        <div class="col-md-6">
            <p><strong>Description :</strong> {{ $menu->description ?? 'Aucune description disponible.' }}</p>
        </div>
    </div>
    

    
    <div class="mt-4">
        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu?')">Supprimer</button>
        </form>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection