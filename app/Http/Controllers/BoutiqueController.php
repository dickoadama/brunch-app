<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Menu;
use App\Models\Table;
// Suppression de l'importation inutilisée: use Illuminate\Support\Str;

class BoutiqueController extends Controller
{
    /**
     * Affiche la boutique en ligne avec tous les éléments disponibles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer les tickets actifs
        $tickets = Ticket::where('actif', true)->get();
        
        // Récupérer les menus
        $menus = Menu::all();
        
        // Récupérer les tables
        $tables = Table::all();
        
        return view('boutique.index', compact('tickets', 'menus', 'tables'));
    }
}