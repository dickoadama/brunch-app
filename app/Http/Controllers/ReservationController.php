<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use App\Models\Table;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::with(['client', 'table'])->latest()->paginate(10);
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $tables = Table::all();
        return view('reservations.create', compact('clients', 'tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_reservation' => 'required|date',
            'nombre_personnes' => 'required|integer|min:1',
            'statut' => 'required|in:confirmée,en attente,annulée',
            'commentaires' => 'nullable|string',
            'table_id' => 'nullable|exists:tables,id'
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['client', 'table']);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $clients = Client::all();
        $tables = Table::all();
        return view('reservations.edit', compact('reservation', 'clients', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_reservation' => 'required|date',
            'nombre_personnes' => 'required|integer|min:1',
            'statut' => 'required|in:confirmée,en attente,annulée',
            'commentaires' => 'nullable|string',
            'table_id' => 'nullable|exists:tables,id'
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    /**
     * Afficher le formulaire de paiement pour une réservation.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function payer(Reservation $reservation)
    {
        return view('reservations.payer', compact('reservation'));
    }

    /**
     * Traiter le paiement d'une réservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function traiterPaiement(Request $request, Reservation $reservation)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'methode' => 'required|string',
        ]);

        // Créer le paiement
        $paiement = Paiement::create([
            'reference' => 'PAY-RES-' . strtoupper(Str::random(6)),
            'montant' => $request->montant,
            'methode' => $request->methode,
            'statut' => 'valide',
            'reservation_id' => $reservation->id,
            // Générer un QR code (simulation)
            'qr_code' => 'QR_CODE_' . strtoupper(Str::random(20)),
        ]);

        // Mettre à jour la réservation
        $reservation->update(['statut' => 'confirmée']);

        return redirect()->route('reservations.show', $reservation)->with('success', 'Paiement effectué avec succès.');
    }
}
