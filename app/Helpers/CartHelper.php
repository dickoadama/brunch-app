<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class CartHelper
{
    /**
     * Obtenir le nombre total d'articles dans le panier
     *
     * @return int
     */
    public static function getCartCount()
    {
        $panier = Session::get('panier', []);
        $totalCount = 0;
        
        foreach ($panier as $item) {
            $totalCount += $item['quantite'];
        }
        
        return $totalCount;
    }
}