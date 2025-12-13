<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'type'
    ];

    protected $casts = [
        // Aucun cast spécifique nécessaire pour ce modèle
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}