<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'date_menu',
        'prix',
        'type',
        'categorie_id',
        'image_path'
    ];

    protected $casts = [
        'date_menu' => 'date',
        'prix' => 'decimal:2',
        'categorie_id' => 'integer'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

}
