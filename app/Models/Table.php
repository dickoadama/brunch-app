<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_table',
        'capacite',
        'emplacement',
        'statut',
        'description',
        'image_path'
    ];

    protected $casts = [
        'disponible' => 'boolean'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
