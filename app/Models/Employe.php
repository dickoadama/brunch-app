<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'poste',
        'salaire',
        'date_embauche'
    ];

    protected $casts = [
        'salaire' => 'decimal:2',
        'date_embauche' => 'date'
    ];
}
