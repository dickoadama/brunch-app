<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Menu;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::with(['client', 'menu'])->latest()->paginate(10);
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $menus = Menu::all();
        return view('commandes.create', compact('clients', 'menus'));
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
            'menu_id' => 'required|exists:menus,id',
            'date_commande' => 'required|date',
            'nombre_personnes' => 'required|integer|min:1',
            'quantite' => 'required|integer|min:1',
            'montant_total' => 'required|numeric|min:0',
            'statut' => 'required|in:confirmée,en attente,annulée',
            'commentaires' => 'nullable|string'
        ]);

        Commande::create($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        $commande->load(['client', 'menu']);
        return view('commandes.show', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        $clients = Client::all();
        $menus = Menu::all();
        return view('commandes.edit', compact('commande', 'clients', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'menu_id' => 'required|exists:menus,id',
            'date_commande' => 'required|date',
            'nombre_personnes' => 'required|integer|min:1',
            'quantite' => 'required|integer|min:1',
            'montant_total' => 'required|numeric|min:0',
            'statut' => 'required|in:confirmée,en attente,annulée',
            'commentaires' => 'nullable|string'
        ]);

        $commande->update($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }

    /**
     * Afficher le formulaire de paiement pour une commande.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function payer(Commande $commande)
    {
        return view('commandes.payer', compact('commande'));
    }

    /**
     * Traiter le paiement d'une commande.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function traiterPaiement(Request $request, Commande $commande)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'methode' => 'required|string',
        ]);

        // Créer le paiement
        $paiement = Paiement::create([
            'reference' => 'PAY-CMD-' . strtoupper(Str::random(6)),
            'montant' => $request->montant,
            'methode' => $request->methode,
            'statut' => 'valide',
            'commande_id' => $commande->id,
            // Générer un QR code (simulation)
            'qr_code' => 'QR_CODE_' . strtoupper(Str::random(20)),
        ]);

        // Mettre à jour la commande
        $commande->update(['statut' => 'confirmée']);

        return redirect()->route('commandes.show', $commande)->with('success', 'Paiement effectué avec succès.');
    }
}
