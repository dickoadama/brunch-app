<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commande;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiements = Paiement::with(['commande', 'reservation', 'ticket'])->latest()->get();
        return view('paiements.index', compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paiements.create');
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
            'montant' => 'required|numeric|min:0',
            'methode' => 'required|string|max:50',
            'statut' => 'required|string|max:50',
            'commande_id' => 'nullable|exists:commandes,id',
            'reservation_id' => 'nullable|exists:reservations,id',
            'ticket_id' => 'nullable|exists:tickets,id',
        ]);

        $data = $request->all();
        $data['reference'] = 'PAY-' . strtoupper(Str::random(8));
        
        // Générer un QR code (simulation)
        $data['qr_code'] = 'QR_CODE_' . strtoupper(Str::random(20));

        $paiement = Paiement::create($data);

        return redirect()->route('paiements.index')
                        ->with('success', 'Paiement créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function show(Paiement $paiement)
    {
        return view('paiements.show', compact('paiement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function edit(Paiement $paiement)
    {
        return view('paiements.edit', compact('paiement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'statut' => 'required|string|max:50',
        ]);

        $paiement->update($request->all());

        return redirect()->route('paiements.index')
                        ->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return redirect()->route('paiements.index')
                        ->with('success', 'Paiement supprimé avec succès.');
    }

    /**
     * Générer un QR code pour un paiement.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function genererQrCode(Paiement $paiement)
    {
        // Dans une vraie application, vous utiliseriez une bibliothèque comme SimpleSoftwareIO/QrCode
        // Pour cette démonstration, nous simulons la génération
        $qrData = "PAIEMENT:{$paiement->reference}|MONTANT:{$paiement->montant}|METHODE:{$paiement->methode}";
        $paiement->update(['qr_code' => $qrData]);
        
        return redirect()->back()->with('success', 'QR Code généré avec succès.');
    }
}
