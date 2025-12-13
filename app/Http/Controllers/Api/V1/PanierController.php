<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Menu;
use App\Models\Table;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PanierController extends ApiController
{
    /**
     * Display the cart content
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = $this->calculateTotal($cart);
        
        return $this->success([
            'items' => $cart,
            'total' => $total,
            'count' => count($cart)
        ], 'Cart retrieved successfully');
    }

    /**
     * Add an item to the cart
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|in:menu,table,ticket',
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        $itemId = $validatedData['type'] . '_' . $validatedData['id'];
        
        // Check if item exists
        $item = $this->getItem($validatedData['type'], $validatedData['id']);
        if (!$item) {
            return $this->error('Item not found', 404);
        }

        // Add or update item in cart
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $validatedData['quantity'];
        } else {
            $cart[$itemId] = [
                'type' => $validatedData['type'],
                'id' => $validatedData['id'],
                'name' => $item->nom ?? $item->numero_table ?? $item->nom,
                'price' => $item->prix ?? 0,
                'quantity' => $validatedData['quantity'],
                'item' => $item
            ];
        }

        Session::put('cart', $cart);

        return $this->success([
            'items' => $cart,
            'total' => $this->calculateTotal($cart),
            'count' => count($cart)
        ], 'Item added to cart successfully');
    }

    /**
     * Update item quantity in cart
     *
     * @param Request $request
     * @param string $itemId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $itemId)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);

        if (!isset($cart[$itemId])) {
            return $this->error('Item not found in cart', 404);
        }

        $cart[$itemId]['quantity'] = $validatedData['quantity'];

        if ($cart[$itemId]['quantity'] <= 0) {
            unset($cart[$itemId]);
        }

        Session::put('cart', $cart);

        return $this->success([
            'items' => $cart,
            'total' => $this->calculateTotal($cart),
            'count' => count($cart)
        ], 'Cart updated successfully');
    }

    /**
     * Remove an item from the cart
     *
     * @param string $itemId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($itemId)
    {
        $cart = Session::get('cart', []);

        if (!isset($cart[$itemId])) {
            return $this->error('Item not found in cart', 404);
        }

        unset($cart[$itemId]);
        Session::put('cart', $cart);

        return $this->success([
            'items' => $cart,
            'total' => $this->calculateTotal($cart),
            'count' => count($cart)
        ], 'Item removed from cart successfully');
    }

    /**
     * Clear the cart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear()
    {
        Session::forget('cart');

        return $this->success([
            'items' => [],
            'total' => 0,
            'count' => 0
        ], 'Cart cleared successfully');
    }

    /**
     * Calculate total amount in cart
     *
     * @param array $cart
     * @return float
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
        return $total;
    }

    /**
     * Get item by type and id
     *
     * @param string $type
     * @param int $id
     * @return mixed
     */
    private function getItem($type, $id)
    {
        switch ($type) {
            case 'menu':
                return Menu::find($id);
            case 'table':
                return Table::find($id);
            case 'ticket':
                return Ticket::find($id);
            default:
                return null;
        }
    }
}