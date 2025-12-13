<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prix',
        'description',
        'actif'
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'actif' => 'boolean'
    ];

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
