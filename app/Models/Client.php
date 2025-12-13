<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_naissance'
    ];

    protected $casts = [
        'date_naissance' => 'date'
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
