<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paiements = Paiement::all();
        return $this->success($paiements, 'Paiements retrieved successfully');
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
            'reference' => 'required|string|unique:paiements,reference',
            'montant' => 'required|numeric|min:0',
            'methode' => 'required|string|in:carte,espèces,virement,qr_code',
            'statut' => 'required|string|in:en attente,complété,échoué,remboursé',
            'qr_code' => 'nullable|string',
            'commande_id' => 'nullable|exists:commandes,id',
            'reservation_id' => 'nullable|exists:reservations,id',
            'ticket_id' => 'nullable|exists:tickets,id',
        ]);

        $paiement = Paiement::create($validatedData);

        return $this->success($paiement, 'Paiement created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $paiement = Paiement::find($id);

        if (!$paiement) {
            return $this->error('Paiement not found', 404);
        }

        return $this->success($paiement, 'Paiement retrieved successfully');
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
        $paiement = Paiement::find($id);

        if (!$paiement) {
            return $this->error('Paiement not found', 404);
        }

        $validatedData = $request->validate([
            'reference' => 'sometimes|required|string|unique:paiements,reference,'.$paiement->id,
            'montant' => 'sometimes|required|numeric|min:0',
            'methode' => 'sometimes|required|string|in:carte,espèces,virement,qr_code',
            'statut' => 'sometimes|required|string|in:en attente,complété,échoué,remboursé',
            'qr_code' => 'nullable|string',
            'commande_id' => 'nullable|exists:commandes,id',
            'reservation_id' => 'nullable|exists:reservations,id',
            'ticket_id' => 'nullable|exists:tickets,id',
        ]);

        $paiement->update($validatedData);

        return $this->success($paiement, 'Paiement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $paiement = Paiement::find($id);

        if (!$paiement) {
            return $this->error('Paiement not found', 404);
        }

        $paiement->delete();

        return $this->success(null, 'Paiement deleted successfully');
    }

    /**
     * Get paiements by status
     *
     * @param  string  $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function byStatus($status)
    {
        $paiements = Paiement::where('statut', $status)->get();
        return $this->success($paiements, 'Paiements retrieved successfully');
    }
}