<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::where('actif', true)->orderBy('prix')->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
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
            'nom' => 'required|string|max:255|unique:tickets',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'actif' => 'boolean'
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:tickets,nom,'.$ticket->id,
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'actif' => 'boolean'
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket supprimé avec succès.');
    }

    /**
     * Acheter un ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function acheter(Ticket $ticket)
    {
        // Ici, vous pouvez implémenter la logique d'achat
        // Par exemple, créer une commande, envoyer un email, etc.
        return view('tickets.acheter', compact('ticket'));
    }
}
