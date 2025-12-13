<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Reservation;
use App\Models\Client;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $reservations = Reservation::with(['client', 'table'])->get();
        return $this->success($reservations, 'Reservations retrieved successfully');
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
            'date_reservation' => 'required|date',
            'nombre_personnes' => 'required|integer|min:1',
            'statut' => 'required|string|in:confirmée,annulée,en attente',
            'commentaires' => 'nullable|string',
            'table_id' => 'required|exists:tables,id',
        ]);

        $reservation = Reservation::create($validatedData);

        return $this->success($reservation, 'Reservation created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $reservation = Reservation::with(['client', 'table'])->find($id);

        if (!$reservation) {
            return $this->error('Reservation not found', 404);
        }

        return $this->success($reservation, 'Reservation retrieved successfully');
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
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return $this->error('Reservation not found', 404);
        }

        $validatedData = $request->validate([
            'client_id' => 'sometimes|required|exists:clients,id',
            'date_reservation' => 'sometimes|required|date',
            'nombre_personnes' => 'sometimes|required|integer|min:1',
            'statut' => 'sometimes|required|string|in:confirmée,annulée,en attente',
            'commentaires' => 'nullable|string',
            'table_id' => 'sometimes|required|exists:tables,id',
        ]);

        $reservation->update($validatedData);

        return $this->success($reservation, 'Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return $this->error('Reservation not found', 404);
        }

        $reservation->delete();

        return $this->success(null, 'Reservation deleted successfully');
    }

    /**
     * Get reservations by client
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

        $reservations = Reservation::where('client_id', $clientId)->with(['client', 'table'])->get();

        return $this->success($reservations, 'Reservations retrieved successfully');
    }

    /**
     * Get reservations by table
     *
     * @param  int  $tableId
     * @return \Illuminate\Http\JsonResponse
     */
    public function byTable($tableId)
    {
        $table = Table::find($tableId);

        if (!$table) {
            return $this->error('Table not found', 404);
        }

        $reservations = Reservation::where('table_id', $tableId)->with(['client', 'table'])->get();

        return $this->success($reservations, 'Reservations retrieved successfully');
    }
}