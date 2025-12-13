<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'menu_id',
        'date_commande',
        'nombre_personnes',
        'quantite',
        'montant_total',
        'statut',
        'commentaires'
    ];

    protected $casts = [
        'date_commande' => 'datetime',
        'montant_total' => 'decimal:2',
        'nombre_personnes' => 'integer',
        'quantite' => 'integer'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
