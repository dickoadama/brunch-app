<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\CartHelper;
use Illuminate\Support\Facades\Session;

class CartHelperTest extends TestCase
{
    /**
     * Test que le compteur du panier renvoie 0 quand le panier est vide.
     *
     * @return void
     */
    public function test_get_cart_count_returns_zero_when_cart_is_empty()
    {
        // S'assurer que le panier est vide
        Session::flush();
        
        $count = CartHelper::getCartCount();
        
        $this->assertEquals(0, $count);
    }
    
    /**
     * Test que le compteur du panier renvoie le bon nombre quand le panier contient des articles.
     *
     * @return void
     */
    public function test_get_cart_count_returns_correct_number_when_cart_has_items()
    {
        // Simuler un panier avec des articles
        Session::put('panier', [
            'ticket_1' => [
                'id' => 'ticket_1',
                'type' => 'ticket',
                'element_id' => 1,
                'nom' => 'Ticket 5000 FCFA',
                'prix' => 5000,
                'quantite' => 2
            ],
            'menu_1' => [
                'id' => 'menu_1',
                'type' => 'menu',
                'element_id' => 1,
                'nom' => 'Menu Brunch',
                'prix' => 7000,
                'quantite' => 1
            ]
        ]);
        
        $count = CartHelper::getCartCount();
        
        $this->assertEquals(3, $count); // 2 + 1 = 3 articles
    }
}