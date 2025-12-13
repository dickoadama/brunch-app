<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date_reservation',
        'nombre_personnes',
        'statut',
        'commentaires',
        'table_id'
    ];

    protected $casts = [
        'date_reservation' => 'datetime',
        'nombre_personnes' => 'integer'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
