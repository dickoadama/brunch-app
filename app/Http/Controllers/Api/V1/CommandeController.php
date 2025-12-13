<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Menu;
use Illuminate\Http\Request;

class CommandeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $commandes = Commande::with(['client', 'menu'])->get();
        return $this->success($commandes, 'Commandes retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'menu_id' => 'required|exists:menus,id',
            'date_commande' => 'required|date',
            'nombre_personnes' => 'required|integer|min:1',
            'quantite' => 'required|integer|min:1',
            'montant_total' => 'required|numeric|min:0',
            'statut' => 'required|string|in:en attente,en cours,prêt,livré,annulé',
            'commentaires' => 'nullable|string',
        ]);

        $commande = Commande::create($validatedData);

        return $this->success($commande, 'Commande created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $commande = Commande::with(['client', 'menu'])->find($id);

        if (!$commande) {
            return $this->error('Commande not found', 404);
        }

        return $this->success($commande, 'Commande retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return $this->error('Commande not found', 404);
        }

        $validatedData = $request->validate([
            'client_id' => 'sometimes|required|exists:clients,id',
            'menu_id' => 'sometimes|required|exists:menus,id',
            'date_commande' => 'sometimes|required|date',
            'nombre_personnes' => 'sometimes|required|integer|min:1',
            'quantite' => 'sometimes|required|integer|min:1',
            'montant_total' => 'sometimes|required|numeric|min:0',
            'statut' => 'sometimes|required|string|in:en attente,en cours,prêt,livré,annulé',
            'commentaires' => 'nullable|string',
        ]);

        $commande->update($validatedData);

        return $this->success($commande, 'Commande updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return $this->error('Commande not found', 404);
        }

        $commande->delete();

        return $this->success(null, 'Commande deleted successfully');
    }

    /**
     * Get commandes by client
     *
     * @param  int  $clientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function byClient($clientId)
    {
        $client = Client::find($clientId);

        if (!$client) {
            return $this->error('Client not found', 404);
        }

        $commandes = Commande::where('client_id', $clientId)->with(['client', 'menu'])->get();

        return $this->success($commandes, 'Commandes retrieved successfully');
    }

    /**
     * Get commandes by menu
     *
     * @param  int  $menuId
     * @return \Illuminate\Http\JsonResponse
     */
    public function byMenu($menuId)
    {
        $menu = Menu::find($menuId);

        if (!$menu) {
            return $this->error('Menu not found', 404);
        }

        $commandes = Commande::where('menu_id', $menuId)->with(['client', 'menu'])->get();

        return $this->success($commandes, 'Commandes retrieved successfully');
    }
}