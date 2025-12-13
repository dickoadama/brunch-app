<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'montant',
        'methode',
        'statut',
        'qr_code',
        'commande_id',
        'reservation_id',
        'ticket_id'
    ];

    protected $casts = [
        'montant' => 'decimal:2'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
